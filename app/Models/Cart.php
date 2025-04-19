<?php
// File: app/Models/Cart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'session_id',
        'total',
        'status',
    ];
    
    /**
     * Get the items in the cart
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    
    /**
     * Get the user that owns the cart
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tambahkan method untuk menghitung total
    public function updateTotal()
    {
        $this->total = $this->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        $this->save();
    }
}