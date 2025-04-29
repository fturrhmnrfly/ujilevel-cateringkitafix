<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller 
{
    public function index()
    {
        $laporans = Laporan::latest()->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('admin.laporan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'laporan' => 'required',
            'jenis_laporan' => 'required',
            'tanggal' => 'required|date',
            'admin' => 'required',
            'deskripsi' => 'required',
            'status' => 'required'
        ]);

        Laporan::create($validated);

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dibuat');
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('admin.laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'laporan' => 'required',
            'jenis_laporan' => 'required',
            'tanggal' => 'required|date',
            'admin' => 'required',
            'deskripsi' => 'required',
            'status' => 'required'
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update($validated);

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new LaporanExport, 'laporan-keuangan.xlsx');
    }
}
