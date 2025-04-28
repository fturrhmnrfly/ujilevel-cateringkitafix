<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarPesanan;
use Illuminate\Http\Request;

class AdminDaftarPesananController extends Controller
{
    public function index()
    {
        $pesanans = DaftarPesanan::latest()->get();
        return view('admin.daftarpesanan.index', compact('pesanans'));
    }

    public function create()
    {
        return view('admin.daftarpesanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pesanan' => 'required',
            'nama_pelanggan' => 'required',
            'tanggal_pesanan' => 'required|date',
            'jumlah_pesanan' => 'required',
            'tanggal_acara' => 'required|date',
            'lokasi_pengiriman' => 'required',
            'total_harga' => 'required|numeric',
            'status_pengiriman' => 'required|in:diproses,pending,selesai',
            'pesan_untuk_penjual' => 'nullable|string'
        ]);

        DaftarPesanan::create($validated);

        return redirect()->route('admin.daftarpesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pesanan = DaftarPesanan::findOrFail($id);
        return view('admin.daftarpesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = DaftarPesanan::findOrFail($id);

        $validated = $request->validate([
            'nama_pesanan' => 'required',
            'nama_pelanggan' => 'required',
            'tanggal_pesanan' => 'required|date',
            'jumlah_pesanan' => 'required',
            'tanggal_acara' => 'required|date',
            'lokasi_pengiriman' => 'required',
            'total_harga' => 'required|numeric',
            'status_pengiriman' => 'required|in:diproses,pending,selesai',
            'pesan_untuk_penjual' => 'nullable|string'
        ]);

        $pesanan->update($validated);

        return redirect()->route('admin.daftarpesanan.index')
            ->with('success', 'Pesanan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pesanan = DaftarPesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('admin.daftarpesanan.index')
            ->with('success', 'Pesanan berhasil dihapus');
    }
}