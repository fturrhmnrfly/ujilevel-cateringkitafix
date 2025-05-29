<?php
namespace App\Http\Controllers;

use App\Models\TentangKami;
use App\Models\MenuNasiBox;
use App\Models\MenuPrasmanan;
use App\Models\Penilaian;

class DashboardController extends Controller 
{
    public function index()
    {
        $data = [
            'tentangkami' => TentangKami::latest()->first(), // Get the latest TentangKami record
            'menunasibox' => MenuNasiBox::all(),
            'menuprasmanan' => MenuPrasmanan::all(),
            'penilaian' => Penilaian::with('user')->latest()->take(3)->get(),
            'nasibox_count' => MenuNasiBox::count(),
            'prasmanan_count' => MenuPrasmanan::count()
        ];

        return view('dashboard', $data);
    }
}
