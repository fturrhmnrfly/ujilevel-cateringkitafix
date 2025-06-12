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
        $laporans = Laporan::orderBy('tanggal', 'desc')->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('admin.laporan.create');
    }

    public function store(Request $request)
    {
        // ✅ UPDATE VALIDASI - HILANGKAN ADMIN DAN DESKRIPSI DARI REQUIRED ✅
        $validated = $request->validate([
            'laporan' => 'required|string|max:255',
            'jenis_laporan' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date',
            'total' => 'required|numeric|min:0',
            // admin dan deskripsi tidak lagi required
        ]);

        // ✅ OTOMATIS ISI ADMIN DAN DESKRIPSI DENGAN NULL ✅
        $validated['admin'] = null;
        $validated['deskripsi'] = null;

        Laporan::create($validated);

        return redirect()->route('admin.laporan.index')
                        ->with('success', 'Laporan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('admin.laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        
        // ✅ UPDATE VALIDASI - HILANGKAN ADMIN DAN DESKRIPSI DARI REQUIRED ✅
        $validated = $request->validate([
            'laporan' => 'required|string|max:255',
            'jenis_laporan' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date',
            'total' => 'required|numeric|min:0',
            // admin dan deskripsi tidak lagi required
        ]);

        // ✅ OTOMATIS ISI ADMIN DAN DESKRIPSI DENGAN NULL ✅
        $validated['admin'] = null;
        $validated['deskripsi'] = null;

        $laporan->update($validated);

        return redirect()->route('admin.laporan.index')
                        ->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $laporan = Laporan::findOrFail($id);
            $laporan->delete();

            // ✅ RETURN JSON RESPONSE UNTUK AJAX REQUEST ✅
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Laporan berhasil dihapus!'
                ]);
            }

            return redirect()->route('admin.laporan.index')
                            ->with('success', 'Laporan berhasil dihapus!');
                            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Laporan tidak ditemukan'
                ], 404);
            }
            
            return redirect()->route('admin.laporan.index')
                            ->with('error', 'Laporan tidak ditemukan');
                            
        } catch (\Exception $e) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus laporan: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('admin.laporan.index')
                            ->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new LaporanExport, 'laporan-keuangan.xlsx');
    }
}
