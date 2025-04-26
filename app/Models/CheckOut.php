<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    protected $fillable = [
        'user_id',
        'delivery_date',
        'delivery_time', 
        'address',
        'phone',
        'notes',
        'subtotal',
        'shipping_cost',
        'total',
        'status'
    ];

    protected $casts = [
        'delivery_date' => 'date',
        'delivery_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
