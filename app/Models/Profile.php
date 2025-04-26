<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAvatarUrlAttribute()
    {
        $name = $this->first_name;
        $initial = strtoupper(substr($name, 0, 1));
        return "https://ui-avatars.com/api/?name=" . urlencode($initial) . "&background=2c2c77&color=fff&size=120";
    }
}
