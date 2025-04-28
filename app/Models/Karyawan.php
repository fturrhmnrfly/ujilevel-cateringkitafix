<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    
    protected $fillable = [
        'nama_karyawan',
        'username_karyawan',
        'posisi',
        'kontak',
        'tanggal_bergabung',
        'status',
        'keahlian'
    ];

    protected $casts = [
        'tanggal_bergabung' => 'date'
    ];
}
