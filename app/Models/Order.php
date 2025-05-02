<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
        'metode_pembayaran',
        'total_harga',
        'status_pengiriman',
        'status_pembayaran'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}