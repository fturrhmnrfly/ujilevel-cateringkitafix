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
            'items' => 'required|array',
        ]);

        // Simpan data pesanan ke database
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $validated['total'],
            'status' => 'pending_payment',
            'payment_method' => 'dana',
            'payment_status' => 'pending',
            'shipping_address' => $validated['address'],
            'phone_number' => $validated['phone'],
            'notes' => $validated['notes'],
            'delivery_date' => $validated['deliveryDate'] . ' ' . $validated['deliveryTime'],
        ]);

        // Simpan detail item pesanan
        foreach ($validated['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Redirect ke halaman sukses dengan order_id
        return redirect()->route('payment.dana.success', ['order_id' => $order->id]);
    }
}
