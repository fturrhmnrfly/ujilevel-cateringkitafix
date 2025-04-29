<?php
namespace App\Http\Controllers;

use App\Models\KelolaMakanan;
use Illuminate\Http\Request;

class MenuPrasmananController extends Controller
{
    public function index()
    {
        // Get the query builder first
        $query = KelolaMakanan::where('kategori', 'Prasmanan')
                             ->where('status', 'Tersedia')
                             ->orderBy('id', 'asc');
        
        // Debug the query before executing
        \Log::info('Menu Items Query:', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        // Now execute the query
        $menuItems = $query->get();

        // Debug the results
        \Log::info('Query Results:', [
            'count' => $menuItems->count(),
            'items' => $menuItems->toArray()
        ]);

        return view('menuprasmanan.index', compact('menuItems'));
    }

    public function show($id)
    {
        // Find the menu item by ID
        $menu = KelolaMakanan::where('kategori', 'Prasmanan')
                            ->where('status', 'Tersedia')
                            ->findOrFail($id);

        return view('menuprasmanan.show', [
            'menu' => $menu,
            'title' => $menu->nama_makanan . ' - Detail'
        ]);
    }
}
