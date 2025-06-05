<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarPesanan;
use App\Models\Order;
use App\Models\StatusPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            // Log untuk debugging
            Log::info('Checkout request received:', $request->all());
            
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
                'opsi_pengiriman' => 'required|string',
                'pesan' => 'nullable|string',
                'total_harga' => 'required|numeric',
                'items' => 'required|array'
            ]);

            DB::beginTransaction();

            // Create new order - TAMBAHKAN user_id
            $daftarPesanan = DaftarPesanan::create([
                'order_id' => $validated['order_id'],
                'user_id' => Auth::id(), // Tambahkan user_id otomatis
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'kategori_pesanan' => $validated['kategori_pesanan'],
                'tanggal_pesanan' => $validated['tanggal_pesanan'],
                'jumlah_pesanan' => $validated['jumlah_pesanan'],
                'tanggal_pengiriman' => $validated['tanggal_pengiriman'],
                'waktu_pengiriman' => $validated['waktu_pengiriman'],
                'lokasi_pengiriman' => $validated['lokasi_pengiriman'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'opsi_pengiriman' => $validated['opsi_pengiriman'],
                'pesan' => $validated['pesan'] ?? null,
                'total_harga' => $validated['total_harga'],
                'status_pengiriman' => 'diproses',
                'status_pembayaran' => 'pending'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'order_id' => $daftarPesanan->order_id,
                'user_id' => $daftarPesanan->user_id
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
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

    /**
     * Update order status with improved error handling and validation
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            // Log the incoming request for debugging
            Log::info('Update status request received', [
                'order_id' => $id,
                'request_data' => $request->all(),
                'admin_id' => Auth::id()
            ]);

            // Find the order
            $pesanan = DaftarPesanan::find($id);
            if (!$pesanan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan'
                ], 404);
            }
            
            // Validate request data
            $validated = $request->validate([
                'status_pengiriman' => 'required|in:diproses,dikirim,diterima,dibatalkan',
                'catatan' => 'nullable|string|max:1000'
            ]);

            // Get current and new status
            $currentStatus = $pesanan->status_pengiriman;
            $newStatus = $validated['status_pengiriman'];
            
            // Validate status transition
            if (!$this->isValidStatusTransition($currentStatus, $newStatus)) {
                return response()->json([
                    'success' => false,
                    'message' => "Tidak dapat mengubah status dari '{$currentStatus}' ke '{$newStatus}'"
                ], 422);
            }

            // Prepare update data
            $updateData = [
                'status_pengiriman' => $newStatus,
                'updated_at' => now()
            ];

            // Add specific data based on status change
            switch ($newStatus) {
                case 'dibatalkan':
                    $updateData['catatan_pembatalan'] = $validated['catatan'] ?? 'Dibatalkan oleh admin';
                    $updateData['cancelled_at'] = now();
                    $updateData['cancelled_by'] = Auth::id();
                    break;
                    
                case 'dikirim':
                    $updateData['shipped_at'] = now();
                    $updateData['shipped_by'] = Auth::id();
                    break;
                    
                case 'diterima':
                    $updateData['delivered_at'] = now();
                    $updateData['confirmed_by'] = Auth::id();
                    break;
            }

            // Update the order
            $updated = $pesanan->update($updateData);
            
            if (!$updated) {
                throw new \Exception('Gagal menyimpan perubahan ke database');
            }

            // Log the successful update
            Log::info('Order status updated successfully', [
                'order_id' => $pesanan->order_id,
                'old_status' => $currentStatus,
                'new_status' => $newStatus,
                'admin_id' => Auth::id(),
                'catatan' => $validated['catatan'] ?? null
            ]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Status pesanan berhasil diperbarui',
                'data' => [
                    'id' => $pesanan->id,
                    'order_id' => $pesanan->order_id,
                    'old_status' => $currentStatus,
                    'new_status' => $newStatus,
                    'updated_at' => $pesanan->updated_at->toISOString()
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed for status update', [
                'order_id' => $id,
                'errors' => $e->errors(),
                'admin_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error updating order status', [
                'order_id' => $id,
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'admin_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan internal server. Silakan coba lagi atau hubungi administrator.'
            ], 500);
        }
    }

    /**
     * Validate if status transition is allowed
     * 
     * @param string $currentStatus
     * @param string $newStatus
     * @return bool
     */
    private function isValidStatusTransition($currentStatus, $newStatus)
    {
        // Define allowed status transitions
        $allowedTransitions = [
            'diproses' => ['dikirim', 'dibatalkan'],
            'dikirim' => ['diterima', 'dibatalkan'], // Allow cancellation even after shipped
            'diterima' => [], // No further transitions allowed
            'dibatalkan' => [] // No further transitions allowed
        ];

        // Check if current status exists in transitions map
        if (!isset($allowedTransitions[$currentStatus])) {
            return false;
        }

        // Check if new status is allowed from current status
        return in_array($newStatus, $allowedTransitions[$currentStatus]);
    }
}