<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function show($orderId)
    {
        $order = Order::where('order_id', $orderId)->firstOrFail();
        
        // Calculate remaining time
        $createdAt = Carbon::parse($order->created_at);
        $expiresAt = $createdAt->copy()->addHours(24);
        $remainingTime = $expiresAt->diffInSeconds(now());
        
        if ($remainingTime <= 0 || $order->status === 'expired') {
            $order->status = 'expired';
            $order->save();
            return redirect()->route('orders.expired', $order->id);
        }
        
        $paymentMethods = [
            ['id' => 'bca_va', 'name' => 'BCA Virtual Account', 'icon' => 'credit-card.png'],
            ['id' => 'dana', 'name' => 'Dana', 'icon' => 'dana.png'],
            ['id' => 'gopay', 'name' => 'Gopay', 'icon' => 'gopay.png'],
            ['id' => 'cod', 'name' => 'COD', 'icon' => 'cash.png'],
        ];
        
        return view('payment.show', compact('order', 'remainingTime', 'paymentMethods'));
    }
    
    public function confirm(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'payment_method' => 'required',
        ]);
        
        $order = Order::where('order_id', $request->order_id)->firstOrFail();
        $order->payment_method = $request->payment_method;
        $order->status = 'pending_payment';
        $order->save();
        
        // Redirect to payment confirmation page based on method
        return redirect()->route('payment.instructions', [
            'order_id' => $order->order_id,
            'payment_method' => $request->payment_method
        ]);
    }
}