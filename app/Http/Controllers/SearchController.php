<?php

namespace App\Http\Controllers;

use App\Models\KelolaMakanan;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $results = KelolaMakanan::where('nama_makanan', 'like', "%{$query}%")
                               ->orWhere('deskripsi', 'like', "%{$query}%")
                               ->get();
        
        return view('search-results', compact('results', 'query'));
    }
}
