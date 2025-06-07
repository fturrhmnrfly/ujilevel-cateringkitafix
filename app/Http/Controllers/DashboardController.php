<?php
namespace App\Http\Controllers;

use App\Models\TentangKami;
use App\Models\KelolaMakanan; // Gunakan model yang ada
use App\Models\Review; // Gunakan model yang ada
use Illuminate\Http\Request;

class DashboardController extends Controller 
{
    public function index()
    {
        // Get top reviews with user relationships
        $topReviews = Review::with('user')
                          ->orderBy('average_rating', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->limit(3)
                          ->get();

        // Hitung jumlah menu berdasarkan kategori dari tabel kelola_makanans
        $prasmananCount = KelolaMakanan::where('kategori', 'Prasmanan')
                                    ->where('status', 'Tersedia')
                                    ->count();
                                    
        $nasiBoxCount = KelolaMakanan::where('kategori', 'Nasi Box')
                                   ->where('status', 'Tersedia')
                                   ->count();

        $data = [
            'tentangkami' => TentangKami::latest()->first(),
            'menuprasmanan' => KelolaMakanan::where('kategori', 'Prasmanan')
                                         ->where('status', 'Tersedia')
                                         ->get(),
            'penilaian' => $topReviews, // Gunakan data review yang sama
            'nasibox_count' => $nasiBoxCount,
            'prasmanan_count' => $prasmananCount
        ];

        // Gabungkan data dengan topReviews
        return view('dashboard', array_merge($data, compact('topReviews')));
    }
}
