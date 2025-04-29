<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaians';
    
    protected $fillable = [
        'pesanan_id',
        'rating',
        'komentar'
    ];

    public function pesanan()
    {
        return $this->belongsTo(DaftarPesanan::class, 'pesanan_id');
    }
}
