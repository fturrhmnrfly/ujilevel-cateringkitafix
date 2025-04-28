<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPesanan extends Model
{
    protected $table = 'daftar_pesanans'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'status_pengiriman',
        'catatan_status',
        'order_id',
        'nama_pelanggan', 
        'tanggal_pesanan',
        'jumlah_pesanan',
        'lokasi_pengiriman',
        'nomor_telepon',
        'total_harga',
        'status_pengiriman',
        'status_pembayaran',
        'opsi_pengiriman',
        'pesan_untuk_penjual'
    ];

    protected $casts = [
        'tanggal_pesanan' => 'datetime',
        'total_harga' => 'decimal:2'
    ];
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}