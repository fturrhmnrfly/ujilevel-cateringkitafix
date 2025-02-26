<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatusPembayaran;
use Illuminate\Http\Request;

class AdminStatusPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = StatusPembayaran::all();
        return view('admin.statuspembayaran.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statuspembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required',
            'nama_produk' => 'required',
            'tanggal_transaksi' => 'required',
            'status_transaksi' => 'required',
            'bukti_transaksi' => 'nullable|file|mimes:jpg,jpeg,png,pdf'
        ]);

        $data = $request->all();
        if ($request->hasFile('buktitransaksi')) {
            $data['bukti_transaksi'] = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
        }

        StatusPembayaran::create($data);

        return redirect()->route('admin.statuspembayaran.index')
            ->with('success', 'Status pembayaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusPembayaran $statuspembayaran)
    {
        return view('admin.statuspembayaran.edit', compact('statuspembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusPembayaran $statuspembayaran)
    {
        $request->validate([
            'nama_pembeli' => 'required',
            'nama_produk' => 'required',
            'tanggal_transaksi' => 'required',
            'status_transaksi' => 'required',
            'bukti_transaksi' => 'nullable|file|mimes:jpg,jpeg,png,pdf'
        ]);

        $data = $request->all();
        if ($request->hasFile('buktitransaksi')) {
            $data['bukti_transaksi'] = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
        }

        $statuspembayaran->update($data);

        return redirect()->route('admin.statuspembayaran.index')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusPembayaran $statuspembayaran)
    {
        if ($statuspembayaran->buktitransaksi) {
            \Storage::delete('public/' . $statuspembayaran->buktitransaksi);
        }
        $statuspembayaran->delete();

        return redirect()->route('admin.statuspembayaran.index')
            ->with('success', 'Status pembayaran berhasil dihapus.');
    }
}
