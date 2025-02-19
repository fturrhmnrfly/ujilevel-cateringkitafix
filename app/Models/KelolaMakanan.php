<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaMakanan extends Model
{
    use HasFactory;

    protected $table = 'kelola_makanans';
    protected $fillable = [
        'nama_makanan',
        'kategori',
        'harga',
        'status',
        'deskripsi',
        'image',
    ];
}
