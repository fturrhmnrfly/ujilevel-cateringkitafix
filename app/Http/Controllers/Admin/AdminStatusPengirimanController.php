<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatusPengiriman;
use Illuminate\Http\Request;

class AdminStatusPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = StatusPengiriman::all();
        return view('admin.statuspengiriman.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statuspengiriman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'tanggal_transaksi' => 'required|date',
            'status_pengiriman' => 'required|string',
        ]);

        StatusPengiriman::create($request->all());

        return redirect()->route('statuspengiriman.index')
            ->with('success', 'Status pengiriman berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = StatusPengiriman::findOrFail($id);
        return view('admin.statuspengiriman.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'tanggal_transaksi' => 'required|date',
            'status_pengiriman' => 'required|string',
        ]);

        $status = StatusPengiriman::findOrFail($id);
        $status->update($request->all());

        return redirect()->route('statuspengiriman.index')
            ->with('success', 'Status pengiriman berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = StatusPengiriman::findOrFail($id);
        $status->delete();

        return redirect()->route('statuspengiriman.index')
            ->with('success', 'Status pengiriman berhasil dihapus');
    }
}
