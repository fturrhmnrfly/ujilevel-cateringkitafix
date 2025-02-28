<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);
        return view('cart', ['cart' => $cart]);
    }
    
    public function add(Request $request)
    {
        $itemId = $request->item_id;
        $itemName = $request->item_name;
        $itemPrice = floatval($request->item_price);
        $quantity = intval($request->quantity);

        if ($quantity < 1) {
            return redirect()->back()->with('error', 'Jumlah minimal 1.');
        }

        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Cek apakah item sudah ada di keranjang
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += $quantity;
        } else {
            $cart[$itemId] = [
                'id' => $itemId,
                'name' => $itemName,
                'price' => $itemPrice,
                'quantity' => $quantity,
            ];
        }

        // Hitung total
        $cart[$itemId]['total'] = $cart[$itemId]['price'] * $cart[$itemId]['quantity'];

        // Simpan keranjang ke session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang!');
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
