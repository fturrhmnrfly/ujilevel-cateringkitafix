<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'nama_admin',
        'nama_pelanggan',
        'tanggal_transaksi',
        'id_transaksi',
        'jenis_tindakan',
        'deskripsi_tindakan',
        'total_harga',
        'status_transaksi',
        'bukti_pembayaran'
    ];

    // Cast the date to Carbon instance
    protected $casts = [
        'tanggal_transaksi' => 'datetime'
    ];
}
