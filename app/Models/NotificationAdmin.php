<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{
    protected $fillable = [
        'admin_id',
        'title',
        'message', 
        'icon_type',
        'order_id',
        'is_read',
        'created_at'
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];
}
