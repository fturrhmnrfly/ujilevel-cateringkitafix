<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'jenis_laporan',
        'laporan',
        'deskripsi',
        'total',
        'admin',
        'status'
    ];

    protected $dates = ['tanggal'];
}
