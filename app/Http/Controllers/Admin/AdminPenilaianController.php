<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\DaftarPesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminPenilaianController extends Controller
{
    public function index()
    {
        // PERBAIKAN: Tampilkan SEMUA review (active dan hidden) untuk admin
        $penilaians = Review::with(['user', 'order'])
                           // ->where('status', 'active') // HAPUS FILTER INI
                           ->orderBy('created_at', 'desc')
                           ->get()
                           ->map(function($review) {
                               return (object) [
                                   'id' => $review->id,
                                   'nama_pembeli' => $review->user->name ?? $review->order->nama_pelanggan,
                                   'nama_produk' => $review->order->kategori_pesanan ?? 'Produk Catering',
                                   'rating' => $review->average_rating,
                                   'quality_rating' => $review->quality_rating,
                                   'delivery_rating' => $review->delivery_rating,
                                   'service_rating' => $review->service_rating,
                                   'review_text' => $review->review_text,
                                   'photos' => $review->photos,
                                   'created_at' => $review->created_at,
                                   'order_id' => $review->order_id,
                                   'order_number' => $review->order_number,
                                   'status' => $review->status ?? 'active' // TAMBAH STATUS
                               ];
                           });

        return view('admin.penilaian.index', compact('penilaians'));
    }

    public function show($id)
    {
        $review = Review::with(['user', 'order'])->findOrFail($id);
        
        $penilaian = (object) [
            'id' => $review->id,
            'nama_pembeli' => $review->user->name ?? $review->order->nama_pelanggan,
            'nama_produk' => $review->order->kategori_pesanan ?? 'Produk Catering',
            'rating' => $review->average_rating,
            'quality_rating' => $review->quality_rating,
            'delivery_rating' => $review->delivery_rating,
            'service_rating' => $review->service_rating,
            'review_text' => $review->review_text,
            'photos' => $review->photos,
            'created_at' => $review->created_at,
            'order_id' => $review->order_id,
            'order_number' => $review->order_number
        ];

        return view('admin.penilaian.show', compact('penilaian'));
    }

    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id);
            
            // Delete photos if exist
            if ($review->photos && is_array($review->photos)) {
                foreach ($review->photos as $photoPath) {
                    if (Storage::disk('public')->exists($photoPath)) {
                        Storage::disk('public')->delete($photoPath);
                    }
                }
            }
            
            $review->delete();

            return redirect()->route('admin.penilaian.index')
                ->with('success', 'Review berhasil dihapus');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.penilaian.index')
                ->with('error', 'Gagal menghapus review: ' . $e->getMessage());
        }
    }

    // Method untuk update status review (hide/show)
    public function updateStatus(Request $request, $id)
    {
        try {
            Log::info('UpdateStatus called', [
                'review_id' => $id,
                'request_data' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            $review = Review::findOrFail($id);
            
            $validated = $request->validate([
                'status' => 'required|in:active,hidden,reported'
            ]);
            
            $review->update(['status' => $validated['status']]);
            
            Log::info('Review status updated successfully', [
                'review_id' => $id,
                'old_status' => $review->getOriginal('status'),
                'new_status' => $validated['status']
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Status review berhasil diperbarui',
                'new_status' => $validated['status']
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed for status update', [
                'review_id' => $id,
                'errors' => $e->errors()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Review not found', ['review_id' => $id]);

            return response()->json([
                'success' => false,
                'message' => 'Review tidak ditemukan'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error updating review status', [
                'review_id' => $id,
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method untuk verifikasi review
    public function verify($id)
    {
        try {
            $review = Review::findOrFail($id);
            $review->update(['is_verified' => !$review->is_verified]);
            
            $status = $review->is_verified ? 'diverifikasi' : 'dibatalkan verifikasinya';
            
            return redirect()->route('admin.penilaian.index')
                ->with('success', "Review berhasil {$status}");
                
        } catch (\Exception $e) {
            return redirect()->route('admin.penilaian.index')
                ->with('error', 'Gagal memverifikasi review: ' . $e->getMessage());
        }
    }

    // Method untuk show status active/hidden
    public function toggleStatus(Request $request, $id)
    {
        try {
            $review = Review::findOrFail($id);
            
            // Toggle status antara active dan hidden
            $newStatus = $review->status === 'active' ? 'hidden' : 'active';
            $review->update(['status' => $newStatus]);
            
            $statusText = $newStatus === 'active' ? 'ditampilkan' : 'disembunyikan';
            
            return redirect()->route('admin.penilaian.index')
                ->with('success', "Review berhasil {$statusText}");
                
        } catch (\Exception $e) {
            return redirect()->route('admin.penilaian.index')
                ->with('error', 'Gagal mengubah status review: ' . $e->getMessage());
        }
    }
}
