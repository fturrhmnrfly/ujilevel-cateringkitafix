<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelolaMakanan;
use Illuminate\Http\Request;

class AdminKelolaMakananController extends Controller
{
    public function index()
    {
        $makanans = KelolaMakanan::all();
        return view('admin.kelolamakanan.index', compact('makanans'));
    }

    public function create()
    {
        return view('admin.kelolamakanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_makanan' => 'required|string',
            'kategori' => 'required|string',
            'harga' => 'required|numeric',
            'status' => 'required|string',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        KelolaMakanan::create($validated);
        return redirect()->route('admin.kelolamakanan.index')->with('success', 'Makanan berhasil ditambahkan');
    }

    public function edit(KelolaMakanan $kelolamakanan)
    {
        return view('admin.kelolamakanan.edit', compact('kelolamakanan'));
    }

    public function update(Request $request, KelolaMakanan $kelolamakanan)
    {
        $validated = $request->validate([
            'nama_makanan' => 'required|string',
            'kategori' => 'required|string',
            'harga' => 'required|numeric',
            'status' => 'required|string',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $kelolamakanan->update($validated);
        return redirect()->route('admin.kelolamakanan.index')->with('success', 'Makanan berhasil diperbarui');
    }

    public function destroy(KelolaMakanan $kelolamakanan)
    {
        if ($kelolamakanan->image) {
            \Storage::disk('public')->delete($kelolamakanan->image);
        }

        $kelolamakanan->delete();
        return redirect()->route('admin.kelolamakanan.index')->with('success', 'Makanan berhasil dihapus');
    }
}
