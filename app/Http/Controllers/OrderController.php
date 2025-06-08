<?php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => Auth::id(),
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'delivery_date' => $request->deliveryDate,
                'delivery_time' => $request->deliveryTime,
                'address' => $request->address,
                'phone' => $request->phone,
                'notes' => $request->notes,
                'shipping_method' => $request->shipping['method'],
                'subtotal' => $request->subtotal,
                'shipping_cost' => $request->shipping_cost,
                'total' => $request->total
            ]);

            // Create order items
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'name' => $item['name'],
                    'quantity' => $item['quantity'], 
                    'price' => $item['price']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $order->order_number
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    

    /**
     * Tampilkan daftar pesanan pengguna.
     */
    public function index()
    {
        $orders = Order::with('items.product') // Tambahkan eager loading
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('pesanan.index', compact('orders'));
    }

    /**
     * Tampilkan detail pesanan tertentu.
     */
    public function show($id)
    {
        // Ambil pesanan berdasarkan ID dengan relasi
        $order = Order::with('items.product')
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

        // Kirim data pesanan ke view
        return view('pesanan.show', compact('order'));
    }

    /**
     * Tampilkan pesanan dengan status 'processing'
     */
    public function process()
    {
        $orders = Order::with('items.product')
                    ->where('user_id', Auth::id())
                    ->where('status', 'processing')
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('pesanan.index', compact('orders'));
    }

    /**
     * Tampilkan pesanan dengan status 'shipped'
     */
    public function shipped()
    {
        $orders = Order::with('items.product')
                    ->where('user_id', Auth::id())
                    ->where('status', 'shipped')
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('pesanan.index', compact('orders'));
    }

    /**
     * Tampilkan pesanan dengan status 'completed'
     */
    public function completed()
    {
        $orders = Order::with('items.product')
                    ->where('user_id', Auth::id())
                    ->where('status', 'completed')
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('pesanan.index', compact('orders'));
    }

    public function cancel(Request $request)
{
    try {
        // VALIDASI DULU SEBELUM APA-APA
        $request->validate([
            'order_id' => 'required|string|exists:orders,order_number'
        ]);

        // LALU CARI ORDER BERDASARKAN order_number
        $order = Order::where('order_number', $request->order_id)
                    ->where('status', 'pending')
                    ->where('user_id', Auth::id()) // untuk keamanan
                    ->firstOrFail();

        // UPDATE STATUS
        $order->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => 'Batas waktu pembayaran telah habis'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dibatalkan'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal membatalkan order: ' . $e->getMessage()
        ], 500);
    }
}

public function confirmPayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string|exists:orders,order_number', // Pastikan order_id valid dan ada di tabel orders
            'payment_proof' => 'required|string' // Sesuaikan validasi dengan jenis data payment proof
        ]);
        
        try {
            // Cari pesanan berdasarkan order_number
            $order = Order::where('order_number', $request->order_id)->firstOrFail(); // Ganti findOrFail dengan where() + firstOrFail

            // Update status pembayaran dan status pesanan
            $order->update([
                'payment_status' => 'paid',
                'payment_proof' => $request->payment_proof,
                'status' => 'processing'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil dikonfirmasi.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengkonfirmasi pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }
}