<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DaftarPesanan;
use Illuminate\Support\Facades\Storage;

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

    protected $appends = ['photo_urls'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(DaftarPesanan::class, 'order_id');
    }

    // Accessor untuk mendapatkan URL foto yang benar
    public function getPhotoUrlsAttribute()
    {
        if (!$this->photos || !is_array($this->photos)) {
            return [];
        }

        return collect($this->photos)->map(function ($photo) {
            // Jika sudah berupa URL lengkap, return as is
            if (str_starts_with($photo, 'http')) {
                return $photo;
            }
            
            // Jika path dimulai dengan 'storage/', hilangkan prefix tersebut
            if (str_starts_with($photo, 'storage/')) {
                $photo = str_replace('storage/', '', $photo);
            }
            
            // Jika path dimulai dengan 'public/', hilangkan prefix tersebut
            if (str_starts_with($photo, 'public/')) {
                $photo = str_replace('public/', '', $photo);
            }
            
            // Generate URL menggunakan Storage facade
            return Storage::url($photo);
        })->toArray();
    }

    // Method untuk mendapatkan satu foto utama
    public function getMainPhotoUrlAttribute()
    {
        $urls = $this->photo_urls;
        return !empty($urls) ? $urls[0] : null;
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

    // Method untuk debug - cek apakah file foto ada
    public function checkPhotosExist()
    {
        if (!$this->photos || !is_array($this->photos)) {
            return [];
        }

        $results = [];
        foreach ($this->photos as $photo) {
            $cleanPath = str_replace(['storage/', 'public/'], '', $photo);
            $exists = Storage::disk('public')->exists($cleanPath);
            $fullPath = Storage::disk('public')->path($cleanPath);
            
            $results[] = [
                'original_path' => $photo,
                'clean_path' => $cleanPath,
                'exists' => $exists,
                'full_path' => $fullPath,
                'url' => Storage::url($cleanPath)
            ];
        }
        
        return $results;
    }
}