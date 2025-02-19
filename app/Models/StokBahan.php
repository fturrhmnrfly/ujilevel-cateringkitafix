<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBahan extends Model
{
    protected $fillable = [
        'nama_bahan',
        'stok_tersedia',
        'tanggal_ditambahkan',
        'tanggal_kadaluarsa',
        'status',
        'deskripsi'
    ];

    protected $casts = [
        'tanggal_ditambahkan' => 'date',
        'tanggal_kadaluarsa' => 'date',
    ];
}