<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DaftarPesanan;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'order_number',
        'quality_rating',
        'delivery_rating',
        'service_rating',
        'average_rating',
        'review_text',
        'photos',
        'status',
        'is_verified',
        'reviewed_at'
    ];

    protected $casts = [
        'photos' => 'array',
        'quality_rating' => 'integer',
        'delivery_rating' => 'integer',
        'service_rating' => 'integer',
        'average_rating' => 'decimal:1',
        'is_verified' => 'boolean',
        'reviewed_at' => 'datetime'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(DaftarPesanan::class, 'order_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeByRating($query, $minRating = 1)
    {
        return $query->where('average_rating', '>=', $minRating);
    }

    // Helper method untuk menghitung rata-rata rating
    public function calculateAverageRating()
    {
        return round(($this->quality_rating + $this->delivery_rating + $this->service_rating) / 3, 1);
    }
}