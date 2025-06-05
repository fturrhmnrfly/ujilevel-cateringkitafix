<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\DaftarPesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminPenilaianController extends Controller
{
    public function index()
    {
        // Menggunakan model Review dan menggabungkan dengan data order dan user
        $penilaians = Review::with(['user', 'order'])
                           ->where('status', 'active')
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
                                   'order_number' => $review->order_number
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
            $review = Review::findOrFail($id);
            
            $validated = $request->validate([
                'status' => 'required|in:active,hidden,reported'
            ]);
            
            $review->update(['status' => $validated['status']]);
            
            return response()->json([
                'success' => true,
                'message' => 'Status review berhasil diperbarui'
            ]);
            
        } catch (\Exception $e) {
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
}
