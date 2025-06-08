<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{
    use HasFactory;

    protected $table = 'notification_admins';
    
    protected $fillable = [
        'admin_id',
        'title', 
        'message',
        'type',
        'icon_type',
        'order_id',
        'is_read',
        'data'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function order()
    {
        return $this->belongsTo(DaftarPesanan::class, 'order_id');
    }
}
