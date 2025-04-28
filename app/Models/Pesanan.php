<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'subtotal',
        'shipping_cost',
        'total', // Make sure total is fillable
        'status',
        'payment_method',
        'payment_status',
        'shipping_address',
        'phone_number',
        'delivery_date',
        'delivery_time',
        'notes'
    ];

    public function getTotalAttribute($value)
    {
        // If total is 0 or null, calculate it from subtotal and shipping_cost
        if (!$value) {
            return $this->subtotal + $this->shipping_cost;
        }
        return $value;
    }
}