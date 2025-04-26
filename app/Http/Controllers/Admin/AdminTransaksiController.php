<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::orderBy('tanggal_transaksi', 'desc')->get();
        
        // Ensure dates are Carbon instances
        $transaksis->transform(function($transaksi) {
            if (!$transaksi->tanggal_transaksi instanceof \DateTime) {
                $transaksi->tanggal_transaksi = Carbon::parse($transaksi->tanggal_transaksi);
            }
            return $transaksi;
        });

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function updateStatus($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        // Add your status update logic here
        return response()->json(['success' => true]);
    }

    public function create()
    {
        return view('admin.transaksi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_admin' => 'required',
            'nama_pelanggan' => 'required',
            'tanggal_transaksi' => 'required|date',
            'id_transaksi' => 'required|unique:transaksis',
            'jenis_tindakan' => 'required',
            'deskripsi_tindakan' => 'required',
            'status_transaksi' => 'required|in:Selesai,Dibatalkan',
        ]);

        Transaksi::create($validated);
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dibuat.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_admin' => 'required',
            'status_transaksi' => 'required|in:Selesai,Dibatalkan,Pending',
            'deskripsi_tindakan' => 'required'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function dashboard()
    {
        $transaksis = Transaksi::all();
        $pendapatan = $transaksis->where('jenis_tindakan', 'income')->sum('amount');
        $pengeluaran = $transaksis->where('jenis_tindakan', 'expense')->sum('amount');

        return view('admin.dashboard', compact('transaksis', 'pendapatan', 'pengeluaran'));
    }
}
