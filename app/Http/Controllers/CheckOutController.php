<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function process(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'deliveryDate' => 'required|date',
            'deliveryTime' => 'required',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'notes' => 'nullable|string',
            'subtotal' => 'required|numeric',
            'shipping' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        // Simpan data ke database
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $validated['total'],
            'status' => 'pending_payment',
            'payment_method' => null,
            'payment_status' => 'pending',
            'va_number' => null,
            'payment_expiry' => now()->addHours(2), // Contoh waktu kedaluwarsa 2 jam
            'payment_proof' => null,
        ]);

        // Redirect ke halaman pembayaran
        return redirect()->route('payment.show', ['orderId' => $order->id]);
    }
}
