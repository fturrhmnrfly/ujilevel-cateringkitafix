<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::orderBy('created_at', 'desc')
            ->get()
            ->map(function($transaksi) {
                $transaksi->tanggal_transaksi = Carbon::parse($transaksi->tanggal_transaksi);
                return $transaksi;
            });

        return view('admin.transaksi.index', compact('transaksis'));
    }
}
