<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PesananController extends Controller
{
    public function unpaid()
    {
        $orders = Order::with(['items'])
            ->where('user_id', auth()->id())
            ->where('status', 'unpaid')  // memastikan hanya mengambil yang belum dibayar
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pesanan.belumdibayar', compact('orders'));
    }

    public function process()
    {
        $orders = Order::with(['items'])
            ->where('user_id', auth()->id())
            ->where('status', 'processing')  // filter only orders being processed
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pesanan.diproses', compact('orders'));
    }
}