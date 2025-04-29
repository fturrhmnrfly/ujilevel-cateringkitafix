<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarPesanan;
use App\Models\Order;
use App\Models\StatusPengiriman;
use Illuminate\Http\Request;

class AdminDaftarPesananController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan
        $pesanans = DaftarPesanan::latest()->get();
        
        // Hitung statistik dengan key yang benar
        $stats = [
            'total' => $pesanans->count(),
            'belum_bayar' => $pesanans->where('status_pembayaran', 'pending')->count(),
            'diproses' => $pesanans->where('status_pengiriman', 'diproses')->count(),
            'dikirim' => $pesanans->where('status_pengiriman', 'dikirim')->count(),
            'selesai' => $pesanans->where('status_pengiriman', 'diterima')->count(), // Changed from selesai to diterima
            'dibatalkan' => $pesanans->where('status_pengiriman', 'dibatalkan')->count()
        ];

        return view('admin.daftarpesanan.index', compact('pesanans', 'stats'));
    }

    public function create()
    {
        return view('admin.daftarpesanan.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate incoming request
            $validated = $request->validate([
                'order_id' => 'required|string',
                'nama_pelanggan' => 'required|string',
                'kategori_pesanan' => 'required|string',
                'tanggal_pesanan' => 'required|date',
                'jumlah_pesanan' => 'required|integer',
                'tanggal_pengiriman' => 'required|date',
                'waktu_pengiriman' => 'required',
                'lokasi_pengiriman' => 'required|string',
                'nomor_telepon' => 'required|string',
                'pesan' => 'nullable|string',
                'opsi_pengiriman' => 'required|string',
                'total_harga' => 'required|numeric',
                'status_pengiriman' => 'required|string|in:diproses,dikirim,selesai,dibatalkan', // Changed validation rule
                'status_pembayaran' => 'required|string'
            ]);

            // Create new order
            $daftarPesanan = DaftarPesanan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'data' => $daftarPesanan
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan: ' . $e->getMessage()
            ], 500);
        }
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
            'status_pengiriman' => 'required|in:diproses,dikirim,diterima,dibatalkan',
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

    public function updateStatus(Request $request, $id)
    {
        try {
            $pesanan = DaftarPesanan::findOrFail($id);
            
            $validated = $request->validate([
                'status_pengiriman' => 'required|in:diproses,dikirim,diterima,dibatalkan',
                'catatan' => 'nullable|string'
            ]);

            $pesanan->update([
                'status_pengiriman' => $validated['status_pengiriman'],
                'catatan_status' => $validated['catatan']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status: ' . $e->getMessage()
            ], 500);
        }
    }

    private function mapStatusToOrderStatus($adminStatus)
    {
        return [
            'diproses' => 'processing',
            'dikirim' => 'shipped',
            'diterima' => 'delivered',
            'dibatalkan' => 'cancelled'
        ][$adminStatus] ?? $adminStatus;
    }
}