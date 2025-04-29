<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DaftarPesanan;
use App\Models\Transaksi;
use App\Models\Penilaian;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get today's orders
        $todayOrders = DaftarPesanan::whereDate('created_at', today())->get();
        
        // Get all transactions
        $transaksis = Transaksi::whereYear('tanggal_transaksi', now()->year)
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        // Calculate total income from all completed/paid orders
        $pendapatan = DaftarPesanan::where('status_pembayaran', 'like', '%paid%')
            ->whereIn('status_pengiriman', ['diterima', 'selesai'])
            ->sum('total_harga');

        // Get total orders count for today
        $todayOrderCount = DaftarPesanan::whereDate('created_at', today())
            ->sum('jumlah_pesanan');

        return view('admin.dashboard', compact(
            'todayOrders',
            'transaksis',
            'pendapatan',
            'todayOrderCount'
        ));
    }
}