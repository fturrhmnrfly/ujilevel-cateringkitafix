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
        'pesan',
        'opsi_pengiriman',
        'total_harga',
        'status_pengiriman',
        'status_pembayaran',
        'catatan_status'
    ];

    protected $casts = [
        'tanggal_pesanan' => 'datetime',
        'total_harga' => 'decimal:2'
    ];
}