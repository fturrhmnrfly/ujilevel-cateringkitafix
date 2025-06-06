<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'icon_type',
        'order_id',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(DaftarPesanan::class, 'order_id');
    }

    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    public function getTimeAgoAttribute()
    {
        $now = Carbon::now();
        $created = $this->created_at;
        $diffInMinutes = $now->diffInMinutes($created);
        $diffInHours = $now->diffInHours($created);
        $diffInDays = $now->diffInDays($created);

        if ($diffInMinutes < 1) {
            return 'sekarang';
        } elseif ($diffInMinutes < 60) {
            return $diffInMinutes . ' menit yang lalu';
        } elseif ($diffInHours < 24) {
            return $diffInHours . ' jam yang lalu';
        } elseif ($diffInDays < 7) {
            return $diffInDays . ' hari yang lalu';
        } else {
            return $this->created_at->format('d M Y, H:i');
        }
    }
}
