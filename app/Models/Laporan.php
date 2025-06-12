<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan',
        'jenis_laporan', 
        'tanggal',
        'total',
        'deskripsi',
        'admin'
    ];

    // ✅ TAMBAHKAN CAST UNTUK TANGGAL ✅
    protected $casts = [
        'tanggal' => 'date',
        'total' => 'decimal:2'
    ];

    // ✅ ATAU GUNAKAN DATES (Laravel versi lama) ✅
    protected $dates = [
        'tanggal',
        'created_at',
        'updated_at'
    ];
}
