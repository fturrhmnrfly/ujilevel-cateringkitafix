<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StokBahan;
use Illuminate\Http\Request;

class AdminStokBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data stok bahan
        $stokbahans = StokBahan::all();
        return view('admin.stokbahan.index', compact('stokbahans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form tambah stok bahan
        return view('admin.stokbahan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_bahan' => 'required',
            'stok_tersedia' => 'required',
            'tanggal_ditambahkan' => 'required',
            'tanggal_kadaluarsa' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
        ]);

        

        // Simpan data ke database
        StokBahan::create($request->all());

        return redirect()->route('admin.stokbahan.index')->with('success', 'Stok Bahan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tampilkan detail stok bahan
        $stokBahan = StokBahan::findOrFail($id);
        return view('admin.stokbahan.show', compact('stokBahan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data stok bahan untuk diedit
        $stokBahan = StokBahan::findOrFail($id);
        return view('admin.stokbahan.edit', compact('stokBahan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_bahan' => 'required',
            'stok_tersedia' => 'required',
            'tanggal_ditambahkan' => 'required',
            'tanggal_kadaluarsa' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
        ]);

        // Update data stok bahan
        $stokBahan = StokBahan::findOrFail($id);
        $stokBahan->update($request->all());

        return redirect()->route('admin.stokbahan.index')
            ->with('success', 'Stok Bahan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data stok bahan
        $stokBahan = StokBahan::findOrFail($id);
        $stokBahan->delete();

        return redirect()->route('admin.stokbahan.index')
            ->with('success', 'Stok Bahan berhasil dihapus.');
    }
}
