<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pembeli',
        'nama_produk',
        'tanggal_transaksi',
        'status_transaksi',
        'bukti_transaksi',
    ];
}
