<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
            
        return view('pesanan.index', compact('orders'));
    }

    public function items()
{
    return $this->hasMany(OrderItem::class);
}
    public function pending()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->latest()
            ->get();
            
        return view('pesanan.index', compact('orders'));
    }

    public function processing()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', auth()->id())
            ->where('status', 'processing')
            ->latest()
            ->get();
            
        return view('pesanan.index', compact('orders'));
    }

    public function shipped() 
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', auth()->id())
            ->where('status', 'shipped')
            ->latest()
            ->get();
            
        return view('pesanan.index', compact('orders'));
    }

    public function completed()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', auth()->id())
            ->where('status', 'completed')
            ->latest()
            ->get();
            
        return view('pesanan.index', compact('orders'));
    }

    public function reviews()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', auth()->id())
            ->where('status', 'completed')
            ->whereNull('reviewed_at')
            ->latest()
            ->get();
            
        return view('pesanan.reviews', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        
        // Make sure total is properly calculated
        $order->total = $order->subtotal + $order->shipping_cost;
        
        return view('pesanan.show', compact('order'));
    }

    public function unpaid()
    {
        $orders = Order::with(['items'])
            ->where('user_id', auth()->id())
            ->where('status', 'unpaid')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pesanan.belumdibayar', compact('orders'));
    }
}