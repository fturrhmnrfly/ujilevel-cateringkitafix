<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartItem;
use App\Http\Controllers\Controller;

class CartController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil keranjang aktif untuk user yang sedang login
        $cart = Cart::where('user_id', auth()->id())
                ->where('status', 'active')
                ->first();
        
        $cartItems = [];
        if ($cart) {
            $cartItems = CartItem::where('cart_id', $cart->id)
                        ->with('product')
                        ->get();
        }

        return view('keranjang.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        try {
            DB::beginTransaction();

            // Ambil atau buat keranjang baru
            $cart = Cart::firstOrCreate(
                [
                    'user_id' => auth()->id(),
                    'status' => 'active'
                ],
                [
                    'total' => 0
                ]
            );

            // Cek apakah item sudah ada di keranjang
            $cartItem = CartItem::where('cart_id', $cart->id)
                              ->where('product_id', $request->product_id)
                              ->first();

            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $request->quantity
                ]);
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'price' => $request->price
                ]);
            }

            $cart->updateTotal();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan ke keranjang: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        try {
            $cartItem = CartItem::findOrFail($id);
            $newQuantity = $cartItem->quantity + $request->quantity_change;
            
            if ($newQuantity < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jumlah minimal 1'
                ]);
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
            $cartItem->cart->updateTotal();
            
            return response()->json([
                'success' => true,
                'message' => 'Jumlah berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui jumlah'
            ], 500);
        }
    }

    public function removeItem($id)
    {
        try {
            $cartItem = CartItem::findOrFail($id);
            $cart = $cartItem->cart;
            
            $cartItem->delete();
            $cart->updateTotal();
            
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus item'
            ], 500);
        }
    }

    public function remove(Request $request)
    {
        $itemId = $request->item_id;

        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Hapus item dari keranjang
        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    public function update(Request $request)
    {
        $itemId = $request->item_id;
        $quantity = intval($request->quantity);

        if ($quantity < 1) {
            return redirect()->back()->with('error', 'Jumlah minimal 1.');
        }

        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Update jumlah item
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = $quantity;
            $cart[$itemId]['total'] = $cart[$itemId]['price'] * $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan!');
    }

    public function checkout()
    {
        // Proses checkout (integrasi dengan sistem pembayaran, dll)
        
        // Kosongkan keranjang setelah checkout
        session()->forget('cart');

        return view('checkout')->with('success', 'Checkout berhasil! Keranjang dikosongkan.');
    }
}
