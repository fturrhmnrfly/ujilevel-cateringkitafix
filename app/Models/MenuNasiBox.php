<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuNasiBox extends Model
{
    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'jumlah_tersedia',
        'status'
    ];
}