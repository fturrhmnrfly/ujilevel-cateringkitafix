<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_admin',
        'nama_pelanggan',
        'tanggal_transaksi',
        'id_transaksi',
        'jenis_tindakan',
        'deskripsi_tindakan',
        'status_transaksi',
    ];
}
