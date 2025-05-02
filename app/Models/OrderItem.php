<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'nama_produk',
        'jumlah',
        'harga',
        'subtotal'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
