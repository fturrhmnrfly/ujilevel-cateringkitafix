<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{
    protected $fillable = [
        'title',
        'message',
        'type',
        'is_read',
        'data',
        'admin_id'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data' => 'array'
    ];
}
