<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount', 
        'status',
        'payment_status',
        'shipping_address',
        'phone_number',
        'notes',
        'delivery_date',
        'payment_deadline'
    ];

    protected $dates = [
        'delivery_date',
        'payment_deadline'
    ];

    /**
     * Relasi ke item pesanan
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}