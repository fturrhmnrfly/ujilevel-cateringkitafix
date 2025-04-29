<?php

namespace App\Http\Controllers;

use App\Models\KelolaMakanan;
use Illuminate\Http\Request;

class MenuNasiBoxController extends Controller
{
    public function index()
    {
        // Get menu items from database
        $menuItems = KelolaMakanan::where('kategori', 'Nasi Box')
                                 ->where('status', 'Tersedia')
                                 ->orderBy('id', 'asc')
                                 ->get();

        // Debug query
        \Log::info('Nasi Box Menu Query:', [
            'count' => $menuItems->count(),
            'items' => $menuItems->toArray()
        ]);

        return view('menunasibox.index', compact('menuItems'));
    }

    public function show($id)
    {
        // Find the specific menu item
        $menu = KelolaMakanan::where('kategori', 'Nasi Box')
                            ->where('status', 'Tersedia')
                            ->findOrFail($id);

        return view('menunasibox.show', [
            'menu' => $menu,
            'title' => $menu->nama_makanan . ' - Detail'
        ]);
    }
}