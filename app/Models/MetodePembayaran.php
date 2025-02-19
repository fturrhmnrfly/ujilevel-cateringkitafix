<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'metode_pembayaran',
        'deskripsi',
        'status',
        'admin',
    ];

    protected $casts = [
        'created_at' => 'datetime', // timestamps otomatis mencakup created_at
        'updated_at' => 'datetime',
    ];
}
