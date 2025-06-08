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
        'kelola_makanan_id', // Tambahkan ini
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
        'status_pembayaran',
        // ✅ TAMBAHKAN KOLOM PEMBATALAN KE FILLABLE ✅
        'catatan_pembatalan',
        'cancelled_at',
        'cancelled_by',
        'cancelled_by_type'
    ];

    protected $casts = [
        'tanggal_pesanan' => 'datetime',
        'tanggal_pengiriman' => 'date',
        'waktu_pengiriman' => 'datetime:H:i',
        'total_harga' => 'decimal:2',
        // ✅ TAMBAHKAN CAST UNTUK KOLOM PEMBATALAN ✅
        'cancelled_at' => 'datetime'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tambahkan relasi dengan KelolaMakanan
    public function kelolaMakanan()
    {
        return $this->belongsTo(KelolaMakanan::class, 'kelola_makanan_id');
    }

    // Relasi dengan OrderItems (jika ada)
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
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

    // ✅ TAMBAHKAN RELASI UNTUK CANCELLED_BY ✅
    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    // ✅ TAMBAHKAN ACCESSOR UNTUK NAMA PEMBATAL ✅
    public function getCancelledByNameAttribute()
    {
        if ($this->cancelled_by && $this->cancelledBy) {
            return $this->cancelledBy->name;
        }
        return null;
    }

    // ✅ TAMBAHKAN SCOPE UNTUK FILTER PEMBATALAN ✅
    public function scopeCancelled($query)
    {
        return $query->where('status_pengiriman', 'dibatalkan');
    }

    public function scopeCancelledByUser($query)
    {
        return $query->where('status_pengiriman', 'dibatalkan')
                    ->where('cancelled_by_type', 'user');
    }

    public function scopeCancelledByAdmin($query)
    {
        return $query->where('status_pengiriman', 'dibatalkan')
                    ->where('cancelled_by_type', 'admin');
    }
}