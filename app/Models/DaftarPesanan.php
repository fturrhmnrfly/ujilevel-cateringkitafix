<?php
// app/Models/DaftarPesanan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DaftarPesanan extends Model
{
    use HasFactory;

    protected $table = 'daftar_pesanans'; // Pastikan nama tabel benar
    
    protected $fillable = [
        'order_id',
        'user_id', // Pastikan user_id ada di fillable
        'nama_pelanggan',
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

    // Helper method untuk check apakah order sudah direview
    public function hasReview()
    {
        return $this->reviews()->exists();
    }
    // Helper method untuk check apakah user tertentu sudah review order ini
    public function hasReviewByUser($userId = null)
    {
        $userId = $userId ?? Auth::user()?->id;
        return $this->reviews()->where('user_id', $userId)->exists();
    }

    // Method untuk mendapatkan review dari user tertentu
    public function getReviewByUser($userId = null)
    {
        $userId = $userId ?? Auth::user()?->id;
        return $this->reviews()->where('user_id', $userId)->first();
    }

    // Relasi dengan Review
    public function reviews()
    {
        return $this->hasMany(Review::class, 'order_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'order_id');
    }
}