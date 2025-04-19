<?php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validasi request
            $validated = $request->validate([
                'address' => 'required|string',
                'phone' => 'required|string',
                'notes' => 'nullable|string',
                'deliveryDate' => 'required|date',
                'deliveryTime' => 'required|string',
                'total' => 'required|numeric',
                'items' => 'required|array'
            ]);

            // Set payment deadline 24 jam dari sekarang
            $paymentDeadline = now()->addHours(24);
            
            // Buat order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $validated['total'],
                'shipping_address' => $validated['address'],
                'phone_number' => $validated['phone'],
                'notes' => $validated['notes'],
                'delivery_date' => $validated['deliveryDate'] . ' ' . $validated['deliveryTime'],
                'payment_deadline' => $paymentDeadline,
                'status' => 'pending',
                'payment_status' => 'unpaid'
            ]);

            // Simpan order items
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibuat',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tampilkan daftar pesanan pengguna.
     */
    public function index()
    {
        // Ambil semua pesanan pengguna yang sedang login
        $orders = Order::with('items.product')
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Kirim data ke view
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
                ->where('user_id', auth()->id())
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
                    ->where('user_id', auth()->id())
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
                    ->where('user_id', auth()->id())
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
                    ->where('user_id', auth()->id())
                    ->where('status', 'completed')
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('pesanan.index', compact('orders'));
    }
}