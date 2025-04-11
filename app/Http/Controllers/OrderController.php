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
            
            // Create new order
            $order = new Order();
            $order->user_id = Auth::id();
            $order->total_amount = $request->total;
            $order->status = 'pending';
            $order->payment_status = 'unpaid';
            $order->shipping_address = $request->address;
            $order->phone_number = $request->phone;
            $order->notes = $request->notes;
            $order->delivery_date = $request->deliveryDate . ' ' . $request->deliveryTime;
            $order->payment_deadline = now()->addHours(24);
            $order->save();
            
            // Save order items
            foreach ($request->items as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item['id'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['price'];
                $orderItem->save();
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'order_id' => $order->order_id,
                'message' => 'Order created successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tampilkan daftar pesanan pengguna.
     */
    public function index()
    {
        // Ambil semua pesanan milik pengguna yang sedang login
        $orders = Order::where('user_id', auth()->id())->get();

        // Kirim data pesanan ke view
        return view('orders.index', compact('orders'));
    }

    /**
     * Tampilkan detail pesanan tertentu.
     */
    public function show($id)
    {
        // Ambil pesanan berdasarkan ID
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Kirim data pesanan ke view
        return view('orders.show', compact('order'));
    }
}