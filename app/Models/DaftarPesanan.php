<?php
// app/Models/DaftarPesanan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPesanan extends Model
{
    use HasFactory;

    protected $table = 'daftar_pesanans'; // Pastikan nama tabel benar
    
    protected $fillable = [
        'order_id',
        'nama_pelanggan',
        'user_id',
        'kategori_pesanan',
        'tanggal_pesanan',
        'jumlah_pesanan',
        'tanggal_pengiriman',
        'waktu_pengiriman',
        'lokasi_pengiriman',
        'nomor_telepon',
        'opsi_pengiriman',
        'pesan',
        'total_harga',
        'status_pengiriman',
        'status_pembayaran'
    ];

    protected $casts = [
        'tanggal_pesanan' => 'date',
        'tanggal_pengiriman' => 'date',
        'waktu_pengiriman' => 'datetime:H:i',
        'total_harga' => 'decimal:2'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}