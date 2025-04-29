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
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'nama_makanan' => 'required|string|max:255',
                'kategori' => 'required|string',
                'harga' => 'required|numeric',
                'status' => 'required|string',
                'deskripsi' => 'required|string'
            ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/makanan', $imageName);

            $makanan = KelolaMakanan::create([
                'image' => 'makanan/'.$imageName,
                'nama_makanan' => $request->nama_makanan,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'status' => $request->status,
                'deskripsi' => $request->deskripsi
            ]);

            return redirect()->route('admin.kelolamakanan.index')
                ->with('success', 'Makanan berhasil ditambahkan');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
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
