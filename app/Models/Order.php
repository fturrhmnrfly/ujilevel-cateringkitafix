<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'order_number',
        'user_id',
        'subtotal',
        'shipping_cost',
        'total_amount',
        'shipping_address',
        'phone_number',
        'notes',
        'delivery_date',
        'payment_method',
        'payment_status',
        'payment_proof',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
