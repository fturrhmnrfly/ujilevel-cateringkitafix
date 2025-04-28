<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPesanan extends Model
{
    protected $fillable = [
        'nama_pesanan',
        'nama_pelanggan',
        'tanggal_pesanan',
        'jumlah_pesanan',
        'tanggal_acara',
        'lokasi_pengiriman',
        'total_harga',
        'status_pengiriman',
        'pesan_untuk_penjual' // Add this line
    ];

    protected $casts = [
        'tanggal_pesanan' => 'date',
        'tanggal_acara' => 'date',
    ];
}