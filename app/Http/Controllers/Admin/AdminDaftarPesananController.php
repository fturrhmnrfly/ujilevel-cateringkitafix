<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarPesanan;
use App\Services\AdminNotificationService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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
     * Update order status with comprehensive error handling
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            Log::info('Update status request received', [
                'order_id' => $id,
                'request_data' => $request->all(),
                'admin_id' => Auth::id(),
                'content_type' => $request->header('Content-Type')
            ]);

            // Cari pesanan
            $pesanan = DaftarPesanan::find($id);
            if (!$pesanan) {
                Log::warning('Order not found', ['order_id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan'
                ], 404);
            }

            Log::info('Order found', [
                'order_id' => $pesanan->id,
                'order_number' => $pesanan->order_id,
                'current_status' => $pesanan->status_pengiriman
            ]);

            // Validasi input dengan error handling yang lebih detail
            try {
                $validated = $request->validate([
                    'status_pengiriman' => [
                        'required',
                        'string',
                        'in:diproses,dikirim,diterima,dibatalkan'
                    ],
                    'catatan' => [
                        'nullable',
                        'string',
                        'max:1000'
                    ]
                ], [
                    'status_pengiriman.required' => 'Status pengiriman wajib diisi',
                    'status_pengiriman.in' => 'Status pengiriman tidak valid. Pilihan: diproses, dikirim, diterima, dibatalkan',
                    'catatan.max' => 'Catatan maksimal 1000 karakter'
                ]);

                Log::info('Validation passed', [
                    'validated_data' => $validated
                ]);

            } catch (ValidationException $e) {
                Log::warning('Validation failed', [
                    'errors' => $e->errors(),
                    'input' => $request->all()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid: ' . collect($e->errors())->flatten()->first(),
                    'errors' => $e->errors()
                ], 422);
            }

            $currentStatus = $pesanan->status_pengiriman;
            $newStatus = $validated['status_pengiriman'];
            
            // Cek validasi transisi status
            if (!$this->isValidStatusTransition($currentStatus, $newStatus)) {
                Log::warning('Invalid status transition', [
                    'current_status' => $currentStatus,
                    'new_status' => $newStatus
                ]);

                return response()->json([
                    'success' => false,
                    'message' => "Tidak dapat mengubah status dari '{$currentStatus}' ke '{$newStatus}'"
                ], 422);
            }

            // Validasi khusus untuk pembatalan
            if ($newStatus === 'dibatalkan' && empty(trim($validated['catatan'] ?? ''))) {
                Log::warning('Cancellation reason required', [
                    'new_status' => $newStatus,
                    'catatan' => $validated['catatan'] ?? 'null'
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Alasan pembatalan wajib diisi'
                ], 422);
            }

            // Prepare update data
            $updateData = [
                'status_pengiriman' => $newStatus,
                'updated_at' => now()
            ];

            // Add specific data based on status
            switch ($newStatus) {
                case 'dibatalkan':
                    $updateData['catatan_pembatalan'] = $validated['catatan'] ?? 'Dibatalkan oleh admin';
                    $updateData['cancelled_at'] = now();
                    $updateData['cancelled_by'] = Auth::id();
                    $updateData['cancelled_by_type'] = 'admin';
                    break;
                    
                case 'dikirim':
                    // Optional: add tracking data
                    break;
                    
                case 'diterima':
                    // Optional: add completion data
                    break;
            }

            Log::info('Preparing to update order', [
                'order_id' => $pesanan->id,
                'update_data' => $updateData
            ]);

            // Update the order
            DB::beginTransaction();
            
            $updated = $pesanan->update($updateData);
            
            if (!$updated) {
                throw new \Exception('Gagal menyimpan perubahan ke database');
            }

            // Refresh the model to get updated data
            $pesanan = $pesanan->fresh();

            Log::info('Order status updated successfully', [
                'order_id' => $pesanan->order_id,
                'old_status' => $currentStatus,
                'new_status' => $newStatus,
                'admin_id' => Auth::id(),
                'catatan' => $validated['catatan'] ?? null
            ]);

            // Trigger notifications
            try {
                // Trigger notification untuk user jika status dikirim/diterima
                if ($newStatus === 'dikirim' || $newStatus === 'diterima') {
                    NotificationService::createStatusChangeNotification(
                        $pesanan->id, 
                        $pesanan->user_id, 
                        $currentStatus, 
                        $newStatus
                    );
                    Log::info('User notification triggered');
                }

                // Trigger admin notification untuk order completed (jika diterima)
                if ($newStatus === 'diterima') {
                    AdminNotificationService::createOrderCompletedNotification($pesanan->id);
                    Log::info('Admin notification triggered for completed order');
                }

            } catch (\Exception $notificationError) {
                // Don't fail the main operation if notification fails
                Log::warning('Notification error (non-critical)', [
                    'error' => $notificationError->getMessage()
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status pesanan berhasil diperbarui',
                'data' => [
                    'id' => $pesanan->id,
                    'order_id' => $pesanan->order_id,
                    'old_status' => $currentStatus,
                    'new_status' => $newStatus,
                    'catatan_pembatalan' => $pesanan->catatan_pembatalan,
                    'cancelled_at' => $pesanan->cancelled_at?->format('Y-m-d H:i:s'),
                    'cancelled_by_type' => $pesanan->cancelled_by_type,
                    'updated_at' => $pesanan->updated_at->format('Y-m-d H:i:s')
                ]
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Error updating order status', [
                'order_id' => $id,
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
                'admin_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if status transition is valid
     */
    private function isValidStatusTransition($currentStatus, $newStatus)
    {
        $allowedTransitions = [
            'diproses' => ['dikirim', 'dibatalkan'],
            'dikirim' => ['diterima', 'dibatalkan'],
            'diterima' => [], // Final status
            'dibatalkan' => [] // Final status
        ];

        $allowed = $allowedTransitions[$currentStatus] ?? [];
        
        Log::info('Status transition check', [
            'current_status' => $currentStatus,
            'new_status' => $newStatus,
            'allowed_transitions' => $allowed,
            'is_valid' => in_array($newStatus, $allowed)
        ]);

        return in_array($newStatus, $allowed);
    }
}