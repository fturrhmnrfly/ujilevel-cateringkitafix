<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'payment_method',
        'amount',
        'status',
        'proof_of_payment',
        'payment_date'
    ];

    protected $casts = [
        'payment_date' => 'datetime'
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Helper method untuk mengecek apakah waktu pembayaran masih valid.
     */
    public function isPaymentTimeValid()
    {
        if (!$this->payment_expiry) {
            return false;
        }

        return now()->lt($this->payment_expiry);
    }

    /**
     * Helper method untuk mendapatkan label status pembayaran.
     */
    public function getStatusLabelAttribute()
    {
        $statusMap = [
            'pending_payment' => 'Menunggu Pembayaran',
            'paid' => 'Pembayaran Berhasil',
            'failed' => 'Pembayaran Gagal',
            'expired' => 'Pembayaran Kedaluwarsa',
        ];

        return $statusMap[$this->status] ?? $this->status;
    }
}
