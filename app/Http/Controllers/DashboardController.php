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
        // Get menu counts for categories
        $nasiBoxCount = KelolaMakanan::where('kategori', 'Nasi Box')
                                ->where('status', 'Tersedia')
                                ->count();
    
        $prasmananCount = KelolaMakanan::where('kategori', 'Prasmanan')
                                  ->where('status', 'Tersedia')
                                  ->count();

        // Get top reviews (existing code)
        $topReviews = Review::with('user')
                          ->orderBy('average_rating', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->limit(3)
                          ->get();

        // Get menu data for display
        $menuNasiBox = KelolaMakanan::where('kategori', 'Nasi Box')
                                ->where('status', 'Tersedia')
                                ->orderBy('id', 'asc')
                                ->limit(6) // Limit untuk tampilan dashboard
                                ->get();

        $menuPrasmanan = KelolaMakanan::where('kategori', 'Prasmanan')
                                  ->where('status', 'Tersedia')
                                  ->orderBy('id', 'asc')
                                  ->limit(6) // Limit untuk tampilan dashboard
                                  ->get();

        $data = [
            'menunasibox' => $menuNasiBox,
            'menuprasmanan' => $menuPrasmanan,
            'penilaian' => $topReviews,
            'nasibox_count' => $nasiBoxCount,
            'prasmanan_count' => $prasmananCount
        ];

        return view('dashboard', array_merge($data, compact('topReviews')));
    }
}
