<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeranjangItem extends Model
{
    protected $fillable = [
        'keranjang_id',
        'kelola_makanan_id',
        'nama_produk',
        'price',
        'quantity',
        'image'
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function kelolaMakanan()
    {
        return $this->belongsTo(KelolaMakanan::class, 'kelola_makanan_id');
    }
}
