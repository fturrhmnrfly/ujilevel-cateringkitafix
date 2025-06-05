<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\DaftarPesanan;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validasi request
            $validated = $request->validate([
                'order_id' => 'required|exists:daftar_pesanans,id',
                'quality_rating' => 'required|integer|min:1|max:5',
                'delivery_rating' => 'required|integer|min:1|max:5',
                'service_rating' => 'required|integer|min:1|max:5',
                'review_text' => 'nullable|string|max:500',
                'photos' => 'nullable|array|max:4',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120' // Max 5MB per foto
            ]);

            $userId = Auth::id();
            $orderId = $validated['order_id'];

            // Check apakah order milik user yang sedang login
            $order = DaftarPesanan::where('id', $orderId)
                                  ->where('user_id', $userId)
                                  ->where('status_pengiriman', 'diterima')
                                  ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order tidak ditemukan atau belum dapat direview'
                ], 404);
            }

            // Check apakah user sudah pernah review order ini
            $existingReview = Review::where('user_id', $userId)
                                   ->where('order_id', $orderId)
                                   ->first();

            if ($existingReview) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah pernah memberikan review untuk pesanan ini'
                ], 422);
            }

            DB::beginTransaction();

            // Handle photo uploads
            $photoPaths = [];
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('reviews', 'public');
                    $photoPaths[] = $path;
                }
            }

            // Calculate average rating
            $averageRating = round(($validated['quality_rating'] + $validated['delivery_rating'] + $validated['service_rating']) / 3, 1);

            // Create review
            $review = Review::create([
                'user_id' => $userId,
                'order_id' => $orderId,
                'order_number' => $order->order_id,
                'quality_rating' => $validated['quality_rating'],
                'delivery_rating' => $validated['delivery_rating'],
                'service_rating' => $validated['service_rating'],
                'average_rating' => $averageRating,
                'review_text' => $validated['review_text'],
                'photos' => $photoPaths,
                'status' => 'active',
                'is_verified' => false,
                'reviewed_at' => now()
            ]);

            DB::commit();

            Log::info('Review submitted successfully', [
                'review_id' => $review->id,
                'user_id' => $userId,
                'order_id' => $orderId,
                'average_rating' => $averageRating
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Review berhasil dikirim! Terima kasih atas feedback Anda.',
                'data' => [
                    'review_id' => $review->id,
                    'average_rating' => $averageRating,
                    'photos_count' => count($photoPaths)
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Review submission error', [
                'user_id' => Auth::id(),
                'order_id' => $request->order_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim review. Silakan coba lagi.'
            ], 500);
        }
    }

    public function show($orderId)
    {
        $review = Review::where('order_id', $orderId)
                       ->where('user_id', Auth::id())
                       ->with(['user', 'order'])
                       ->first();

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $review
        ]);
    }
}