<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\DaftarPesanan;
use App\Services\NotificationService;

class PesananController extends Controller
{
    /**
     * Display all orders or filtered orders based on status
     */
    public function index(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login');
            }

            // Get current route name untuk filtering
            $currentRoute = $request->route()->getName();
            
            Log::info('PesananController@index called', [
                'user_id' => $user->id,
                'route' => $currentRoute,
                'url' => $request->url()
            ]);

            // Base query dengan relasi
            $query = DaftarPesanan::with(['kelolaMakanan', 'items.product'])
                                  ->where('user_id', $user->id);

            // Filter berdasarkan route
            switch ($currentRoute) {
                case 'pesanan.unpaid':
                    $query->where('status_pembayaran', 'pending');
                    break;
                case 'pesanan.process':
                    $query->where('status_pengiriman', 'diproses')
                          ->where('status_pembayaran', '!=', 'pending');
                    break;
                case 'pesanan.shipped':
                    $query->where('status_pengiriman', 'dikirim');
                    break;
                case 'pesanan.completed':
                    $query->where('status_pengiriman', 'diterima');
                    break;
                case 'pesanan.penilaian':
                    $query->where('status_pengiriman', 'diterima');
                    break;
                case 'pesanan.index':
                default:
                    // Untuk route pesanan.index (root), tampilkan semua pesanan
                    // Tidak ada filter tambahan
                    break;
            }

            $orders = $query->orderBy('created_at', 'desc')->get();

            Log::info('Orders fetched successfully', [
                'route' => $currentRoute,
                'count' => $orders->count()
            ]);

            return view('pesanan.index', compact('orders'));
            
        } catch (\Exception $e) {
            Log::error('Error in PesananController@index: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan saat memuat pesanan');
        }
    }

    /**
     * Accept delivered order - change status from 'dikirim' to 'diterima'
     */
    public function acceptOrder(Request $request, $id)
    {
        try {
            $order = DaftarPesanan::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan'
                ], 404);
            }

            $order->update(['status_pengiriman' => 'diterima']);

            NotificationService::createStatusChangeNotification(
                $order->id,
                Auth::id(),
                'dikirim',
                'diterima'
            );

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil diterima'
            ]);

        } catch (\Exception $e) {
            Log::error('Error accepting order: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }
}