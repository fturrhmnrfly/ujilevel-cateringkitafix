<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatusPengiriman;
use Illuminate\Http\Request;

class AdminStatusPengirimanController extends Controller
{
    public function index()
    {
        $statusPengiriman = StatusPengiriman::all();
        return view('admin.statuspengiriman.index', compact('statusPengiriman'));
    }

    public function create()
    {
        return view('admin.statuspengiriman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required',
            'nama_produk' => 'required',
            'tanggal_transaksi' => 'required|date',
            'status_pengiriman' => 'required|in:Dikirim,Selesai,Batal',
        ]);

        StatusPengiriman::create($request->all());

        return redirect()->route('admin.statuspengiriman.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $statusPengiriman = StatusPengiriman::findOrFail($id);
        return view('admin.statuspengiriman.edit', compact('statusPengiriman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pembeli' => 'required',
            'nama_produk' => 'required',
            'tanggal_transaksi' => 'required|date',
            'status_pengiriman' => 'required|in:Dikirim,Selesai,Batal',
        ]);

        $statusPengiriman = StatusPengiriman::findOrFail($id);
        $statusPengiriman->update($request->all());

        return redirect()->route('admin.statuspengiriman.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $statusPengiriman = StatusPengiriman::findOrFail($id);
        $statusPengiriman->delete();

        return redirect()->route('admin.statuspengiriman.index')->with('success', 'Data berhasil dihapus!');
    }
}
