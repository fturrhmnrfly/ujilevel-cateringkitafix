<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'phone', 'address', 'password'
    ];
    
}
