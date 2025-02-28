<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuPrasmananController extends Controller
{
    public function index()
    {
        return view('menuprasmanan.index');
    }

    public function search(Request $request)
{
    $query = $request->input('query');
    
    // Cari menu berdasarkan nama atau deskripsi
    $results = Menu::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->get();
    
    return view('search-results', [
        'results' => $results,
        'query' => $query
    ]);
}
}
