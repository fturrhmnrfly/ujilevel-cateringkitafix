<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        return view('keranjang.index');
    }

    public function addToCart(Request $request)
    {
        // Add to cart logic
    }

    public function updateQuantity(Request $request, $id)
    {
        // Update quantity logic
    }

    public function removeItem($id)
    {
        // Remove item logic
    }
}
