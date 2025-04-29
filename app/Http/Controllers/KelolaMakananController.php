<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaMakanan;

class KelolaMakananController extends Controller
{
    public function index()
    {
        $makanan = KelolaMakanan::all();
        return view('admin.kelolamakanan.home', compact('makanan'));
    }

    public function create()
    {
        return view('admin.kelolamakanan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|string',
            'deskripsi' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Convert price to full amount (if needed)
        $validatedData['harga'] = (int) $validatedData['harga'];

        // ...rest of store logic...
    }
}
