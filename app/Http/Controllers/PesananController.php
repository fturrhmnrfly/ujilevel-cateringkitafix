<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    /**
     * Display all orders or filtered orders based on status
     */
    public function index(Request $request)
    {
        try {
            // Debug: Log current route dan user
            Log::info('Route accessed:', [
                'route' => $request->route()->getName(),
                'user' => Auth::user()->name,
                'user_id' => Auth::id()
            ]);

            $query = DaftarPesanan::where('nama_pelanggan', Auth::user()->name);
            $currentRoute = $request->route()->getName();
            
            // Debug: Log sebelum filter
            $totalOrders = (clone $query)->count();
            Log::info('Total orders before filter:', ['count' => $totalOrders]);
            
            // Apply filters based on route
            $orders = $this->applyStatusFilter($query, $currentRoute)
                         ->orderBy('created_at', 'desc')
                         ->get();

            // Debug: Log setelah filter
            Log::info('Orders after filter:', [
                'route' => $currentRoute,
                'count' => $orders->count(),
                'orders' => $orders->pluck(['order_id', 'status_pembayaran', 'status_pengiriman'])->toArray()
            ]);

            // Handle potential data formatting issues
            $orders = $this->formatOrderData($orders);

            return view('pesanan.index', compact('orders'));
            
        } catch (\Exception $e) {
            Log::error('Error fetching orders: ' . $e->getMessage());
            return view('pesanan.index', ['orders' => collect()]);
        }
    }

    /**
     * Show unpaid orders
     */
    public function unpaid(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Show processing orders
     */
    public function process(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Show shipped orders
     */
    public function shipped(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Show completed orders
     */
    public function completed(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Show orders ready for review
     */
    public function penilaian(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Apply status filter based on route - PERBAIKAN LOGIC
     */
    private function applyStatusFilter($query, $routeName)
    {
        Log::info('Applying filter for route:', ['route' => $routeName]);
        
        switch ($routeName) {
            case 'pesanan.unpaid':
                Log::info('Filtering: Belum bayar (status_pembayaran = pending)');
                return $query->where('status_pembayaran', 'pending');
                
            case 'pesanan.process':
                Log::info('Filtering: Diproses (status_pengiriman = diproses AND status_pembayaran != pending)');
                return $query->where('status_pengiriman', 'diproses')
                            ->where('status_pembayaran', '!=', 'pending');
                
            case 'pesanan.shipped':
                Log::info('Filtering: Dikirim (status_pengiriman = dikirim)');
                return $query->where('status_pengiriman', 'dikirim');
                
            case 'pesanan.completed':
                Log::info('Filtering: Selesai (status_pengiriman = diterima)');
                return $query->where('status_pengiriman', 'diterima');
                
            case 'pesanan.penilaian':
                Log::info('Filtering: Penilaian (status_pengiriman = diterima AND status_pembayaran = paid)');
                return $query->where('status_pengiriman', 'diterima')
                            ->where('status_pembayaran', 'paid');
                
            case 'pesanan.index':
            default: 
                Log::info('Filtering: Semua pesanan (no filter)');
                return $query; // Tidak ada filter, tampilkan semua
        }
    }

    /**
     * Format order data to handle potential null values
     */
    private function formatOrderData($orders)
    {
        return $orders->map(function ($order) {
            // Handle potential null values
            $order->order_id = $order->order_id ?? 'N/A';
            $order->kategori_pesanan = $order->kategori_pesanan ?? 'Unknown';
            $order->jumlah_pesanan = $order->jumlah_pesanan ?? 0;
            $order->lokasi_pengiriman = $order->lokasi_pengiriman ?? 'Alamat tidak tersedia';
            $order->nomor_telepon = $order->nomor_telepon ?? 'No telepon tidak tersedia';
            $order->opsi_pengiriman = $order->opsi_pengiriman ?? 'Tidak diketahui';
            $order->total_harga = $order->total_harga ?? 0;
            $order->status_pengiriman = $order->status_pengiriman ?? 'pending';
            $order->status_pembayaran = $order->status_pembayaran ?? 'pending';
            
            // Ensure dates are properly formatted
            try {
                if ($order->tanggal_pengiriman && !is_object($order->tanggal_pengiriman)) {
                    $order->tanggal_pengiriman = \Carbon\Carbon::parse($order->tanggal_pengiriman);
                }
            } catch (\Exception $e) {
                $order->tanggal_pengiriman = \Carbon\Carbon::now();
            }
            
            return $order;
        });
    }

    /**
     * Debug method untuk melihat data raw
     */
    public function debug()
    {
        $user = Auth::user();
        $allOrders = DaftarPesanan::where('nama_pelanggan', $user->name)->get();
        
        Log::info('DEBUG - All orders for user:', [
            'user' => $user->name,
            'total_orders' => $allOrders->count(),
            'orders' => $allOrders->map(function($order) {
                return [
                    'order_id' => $order->order_id,
                    'status_pembayaran' => $order->status_pembayaran,
                    'status_pengiriman' => $order->status_pengiriman,
                    'created_at' => $order->created_at
                ];
            })->toArray()
        ]);
        
        return response()->json(['debug' => 'Check laravel.log for details']);
    }
}