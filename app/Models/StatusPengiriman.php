<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengiriman extends Model
{
    use HasFactory;

    protected $table = 'status_pengirimen';

    protected $fillable = [
        'nama_pembeli',
        'nama_produk',
        'tanggal_transaksi',
        'status_pengiriman',
    ];
}
