<?php
// File: app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the cart contents
     */
    public function index()
    {
        // Get the cart for the current user or session
        $cart = $this->getOrCreateCart();
        $cartItems = $cart->items; // Assuming a relationship is set up
        
        return view('cart.index', compact('cart', 'cartItems'));
    }
    
    /**
     * Add an item to the cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'item_name' => 'required|string',
            'item_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);
        
        // Get the current cart
        $cart = $this->getOrCreateCart();
        
        // Check if the item already exists in the cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('item_id', $request->item_id)
            ->first();
            
        if ($cartItem) {
            // Update existing item quantity
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Add new item to cart
            CartItem::create([
                'cart_id' => $cart->id,
                'item_id' => $request->item_id,
                'name' => $request->item_name,
                'price' => $request->item_price,
                'quantity' => $request->quantity,
            ]);
        }
        
        // Update cart total
        $this->updateCartTotal($cart);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Item added to cart',
                'cartCount' => $cart->items->sum('quantity')
            ]);
        }
        
        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }
    
    /**
     * Update cart item quantity
     */
    public function updateQuantity(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:0',
        ]);
        
        $cart = $this->getOrCreateCart();
        
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('id', $request->item_id)
            ->first();
            
        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart'
            ]);
        }
        
        if ($request->quantity == 0) {
            $cartItem->delete();
        } else {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }
        
        $this->updateCartTotal($cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Quantity updated',
            'cartTotal' => $cart->total,
            'cartCount' => $cart->items->sum('quantity')
        ]);
    }
    
    /**
     * Remove an item from the cart
     */
    public function removeItem(Request $request, $itemId)
    {
        $cart = $this->getOrCreateCart();
        
        CartItem::where('cart_id', $cart->id)
            ->where('id', $itemId)
            ->delete();
            
        $this->updateCartTotal($cart);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart',
                'cartCount' => $cart->items->sum('quantity')
            ]);
        }
        
        return redirect()->back()->with('success', 'Item removed from cart!');
    }
    
    /**
     * Get the current cart or create a new one
     */
    private function getOrCreateCart()
    {
        if (Auth::check()) {
            // User is logged in
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
                'status' => 'active'
            ]);
        } else {
            // Guest user - use session ID
            $sessionId = Session::getId();
            $cart = Cart::firstOrCreate([
                'session_id' => $sessionId,
                'status' => 'active'
            ]);
        }
        
        return $cart;
    }
    
    /**
     * Update the cart total based on items
     */
    private function updateCartTotal($cart)
    {
        $total = CartItem::where('cart_id', $cart->id)
            ->selectRaw('SUM(price * quantity) as total')
            ->first()
            ->total;
            
        $cart->total = $total ?? 0;
        $cart->save();
        
        return $cart;
    }
    
    /**
     * Checkout page
     */
    public function checkout()
    {
        $cart = $this->getOrCreateCart();
        
        if ($cart->items->isEmpty()) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }
        
        $cartItems = $cart->items;
        
        return view('cart.checkout', compact('cart', 'cartItems'));
    }
    
    /**
     * Process the order
     */
    public function processOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);
        
        $cart = $this->getOrCreateCart();
        
        if ($cart->items->isEmpty()) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }
        
        // Create order
        $order = \App\Models\Order::create([
            'user_id' => Auth::id() ?? null,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $cart->total,
            'status' => 'pending',
        ]);
        
        // Create order items
        foreach ($cart->items as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item->item_id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->price * $item->quantity,
            ]);
        }
        
        // Clear the cart
        CartItem::where('cart_id', $cart->id)->delete();
        $cart->total = 0;
        $cart->save();
        
        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Your order has been placed successfully!');
    }
}