<?php
// app/Models/DaftarPesanan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPesanan extends Model 
{
    protected $fillable = [
        'order_id',
        'nama_pelanggan', 
        'kategori_pesanan',
        'tanggal_pesanan',
        'jumlah_pesanan',
        'tanggal_pengiriman',
        'waktu_pengiriman',
        'lokasi_pengiriman',
        'nomor_telepon',
        'opsi_pengiriman', // Pastikan ini ada
        'pesan', // Pastikan ini ada
        'total_harga',
        'status_pengiriman',
        'status_pembayaran'
    ];

    protected $casts = [
        'tanggal_pesanan' => 'datetime',
        'tanggal_pengiriman' => 'date',
    ];
}