<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarPesanan;
use Illuminate\Http\Request;

class AdminDaftarPesananController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
       $pesanans = DaftarPesanan::latest()->get();
       return view('admin.daftarpesanan.index', compact('pesanans'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
       return view('admin.daftarpesanan.create');
   }

   /**
    * Store a newly created resource in storage.
    */
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
           'status_pengiriman' => 'required|in:diproses,pending,selesai'
       ]);

       DaftarPesanan::create($validated);

       return redirect()->route('admin.daftarpesanan.index')
           ->with('success', 'Pesanan berhasil ditambahkan');
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
       $pesanan = DaftarPesanan::findOrFail($id);
       return view('admin.daftarpesanan.show', compact('pesanan'));
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(string $id)
   {
       $pesanan = DaftarPesanan::findOrFail($id);
       return view('admin.daftarpesanan.edit', compact('pesanan'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
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
           'status_pengiriman' => 'required|in:diproses,pending,selesai'
       ]);

       $pesanan->update($validated);

       return redirect()->route('admin.daftarpesanan.index')
           ->with('success', 'Pesanan berhasil diupdate');
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
       $pesanan = DaftarPesanan::findOrFail($id);
       $pesanan->delete();

       return redirect()->route('admin.daftarpesanan.index')
           ->with('success', 'Pesanan berhasil dihapus');
   }
}