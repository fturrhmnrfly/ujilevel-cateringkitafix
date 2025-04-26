<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeranjangItem extends Model
{
    protected $fillable = [
        'keranjang_id',
        'nama_produk',
        'price',
        'quantity',
        'image'
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }
}
