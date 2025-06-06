<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuNasiBox extends Model
{
    // Tentukan nama tabel yang benar
    protected $table = 'menus'; // atau sesuai dengan tabel yang ada di database
    
    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'jumlah_tersedia',
        'status'
    ];
}