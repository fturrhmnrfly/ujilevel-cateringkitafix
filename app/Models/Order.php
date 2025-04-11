<?php
// app/Models/Order.php

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
        'payment_method',
        'payment_status',
        'va_number',
        'payment_expiry',
        'payment_proof',
    ];

    protected $casts = [
        'payment_expiry' => 'datetime',
    ];
}