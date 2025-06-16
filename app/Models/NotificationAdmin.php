<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{
    use HasFactory;

    // ✅ GUNAKAN TABEL NOTIFICATIONS YANG SUDAH ADA ✅
    protected $table = 'notifications';
    
    protected $fillable = [
        'user_id', // Gunakan user_id untuk admin_id
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

    // ✅ SCOPE UNTUK FILTER NOTIFIKASI ADMIN ✅
    public function scopeForAdmin($query, $adminId = null)
    {
        $adminId = $adminId ?: auth()->id();
        return $query->where('user_id', $adminId)
                    ->where('type', 'LIKE', 'admin_%'); // Filter notifikasi khusus admin
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(DaftarPesanan::class, 'order_id');
    }
}
