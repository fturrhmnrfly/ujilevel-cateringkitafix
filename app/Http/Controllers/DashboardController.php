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
        // Ambil 3 review terbaik dengan kriteria yang Anda inginkan
        $topReviews = Review::with('user')
            ->where('average_rating', 5.0)
            ->whereNotNull('review_text')
            ->where('review_text', '!=', '')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Data untuk dashboard menggunakan model yang konsisten
        $data = [
            'tentangkami' => TentangKami::latest()->first(),
            'menunasibox' => KelolaMakanan::where('kategori', 'Nasi Box')
                                        ->where('status', 'Tersedia')
                                        ->get(),
            'menuprasmanan' => KelolaMakanan::where('kategori', 'Prasmanan')
                                         ->where('status', 'Tersedia')
                                         ->get(),
            'penilaian' => $topReviews, // Gunakan data review yang sama
            'nasibox_count' => KelolaMakanan::where('kategori', 'Nasi Box')->count(),
            'prasmanan_count' => KelolaMakanan::where('kategori', 'Prasmanan')->count()
        ];

        // Gabungkan data dengan topReviews
        return view('dashboard', array_merge($data, compact('topReviews')));
    }
}
