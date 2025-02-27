<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id', 'user_id', 'total_amount', 'status', 'payment_method',
        'payment_status', 'payment_deadline'
    ];
    
    // Boot method to set unique order_id when creating a new order
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($order) {
            // Generate unique order ID if not set
            if (!$order->order_id) {
                $order->order_id = 'ORD' . now()->format('ymd') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }
            
            // Set payment deadline to 24 hours from now
            if (!$order->payment_deadline) {
                $order->payment_deadline = now()->addHours(24);
            }
            
            // Set default status
            if (!$order->status) {
                $order->status = 'pending';
            }
        });
    }
}
