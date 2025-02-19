<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class AdminLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Laporan::all(); // Mengambil semua data laporan
        return view('admin.laporan.index', compact('laporans')); // Mengarahkan ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laporan.create'); // Mengarahkan ke form pembuatan laporan
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'laporan' => 'required',
            'jenis_laporan' => 'required',
            'tanggal' => 'required|date',
            'admin' => 'required',
            'deskripsi' => 'nullable',
            'status' => 'required|in:Selesai,Pending',
        ]);

        // Menyimpan data ke database
        Laporan::create($request->all());

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporans = Laporan::findOrFail($id); // Mengambil data berdasarkan ID
        return view('admin.laporan.show', compact('laporans')); // Mengarahkan ke detail laporan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporans = Laporan::findOrFail($id); // Mengambil data berdasarkan ID
        return view('admin.laporan.edit', compact('laporans')); // Mengarahkan ke form edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'laporan' => 'required',
            'jenis_laporan' => 'required',
            'tanggal' => 'required|date',
            'admin' => 'required',
            'deskripsi' => 'nullable',
            'status' => 'required|in:Selesai,Pending',
        ]);

        // Mengupdate data di database
        $laporans = Laporan::findOrFail($id);
        $laporans->update($request->all());

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data berdasarkan ID
        $laporans = Laporan::findOrFail($id);
        $laporans->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
