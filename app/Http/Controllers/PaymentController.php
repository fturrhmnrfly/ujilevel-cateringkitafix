<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller 
{
    // Remove or comment out the index() method since we're not using it
    
    public function show($method)
    {
        // Validate payment method
        $allowedMethods = ['bca', 'dana', 'gopay', 'cod'];
        
        if (!in_array($method, $allowedMethods)) {
            abort(404, 'Metode pembayaran tidak valid');
        }

        // Get latest transaction
        $transaksi = Transaksi::latest()->first();

        // Payment method specific data
        $paymentData = [
            'bca' => [
                'title' => 'Pembayaran BCA Virtual Account',
                'account_number' => '123456789',
                'account_name' => 'CATERING KITA',
                'bank_name' => 'Bank BCA'
            ],
            'dana' => [
                'title' => 'Pembayaran DANA',
                'account_number' => '085712345678',
                'account_name' => 'CATERING KITA'
            ],
            'gopay' => [
                'title' => 'Pembayaran GoPay',
                'account_number' => '085712345678',
                'account_name' => 'CATERING KITA'
            ],
            'cod' => [
                'title' => 'Cash on Delivery (COD)',
                'min_dp' => '30%'
            ]
        ];

        $data = $paymentData[$method];
        $data['method'] = $method;
        $data['transaksi'] = $transaksi;

        return view("metodepembayaran.{$method}", $data);
    }

    public function process(Request $request)
    {
        try {
            DB::beginTransaction();

            $orderData = $request->order_data;
            
            // Validate incoming data
            if (!$orderData) {
                throw new \Exception('Data pesanan tidak valid');
            }

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $orderData['total'],
                'shipping_address' => $orderData['address'],
                'phone_number' => $orderData['phone'],
                'notes' => $orderData['notes'] ?? null,
                'delivery_date' => $orderData['delivery_date'] . ' ' . $orderData['delivery_time'],
                'shipping_cost' => $orderData['shipping_cost'],
                'subtotal' => $orderData['subtotal'],
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_deadline' => now()->addDay()
            ]);

            // Create order items
            foreach ($orderData['items'] as $item) {
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
                'order_id' => $order->id,
                'message' => 'Order berhasil dibuat'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses order: ' . $e->getMessage()
            ], 500);
        }
    }
    
    private function processBcaVirtualAccount($order)
    {
        // Implementasi integrasi dengan BCA Virtual Account
        // Misalnya menggunakan middleware seperti Midtrans, Xendit, dll.
        
        // Contoh kode saja, sesuaikan dengan layanan yang digunakan
        $vaNumber = '12345678901234';
        $expiryTime = now()->addHours(2);
        
        // Update status order
        $order->update([
            'payment_method' => 'bca_va',
            'va_number' => $vaNumber,
            'payment_expiry' => $expiryTime,
            'status' => 'pending_payment'
        ]);
        
        return [
            'success' => true,
            'va_number' => $vaNumber,
            'expiry_time' => $expiryTime
        ];
    }
    
    private function processDana($order)
    {
        // Implementasi integrasi dengan Dana
        // ...
        $vaNumber = '12345678901234';
        $expiryTime = now()->addHours(2);
        
        // Update status order
        $order->update([
            'payment_method' => 'dana',
            'va_number' => $vaNumber,
            'payment_expiry' => $expiryTime,
            'status' => 'pending_payment'
        ]);
        
        return [
            'success' => true,
            'va_number' => $vaNumber,
            'expiry_time' => $expiryTime
        ];
    }
    
    private function processGopay($order)
    {
        // Implementasi integrasi dengan Gopay
        // ...
    }
    
    private function processCod($order)
    {
        // Implementasi untuk COD
        $order->update([
            'payment_method' => 'cod',
            'status' => 'waiting_confirmation'
        ]);
        
        return [
            'success' => true
        ];
    }

    public function bca()
    {
        return view('payments.bca');
    }

    public function dana()
    {
        return view('payments.dana');
    }

    public function gopay()
    {
        return view('payments.gopay');
    }

    public function cod()
    {
        return view('payments.cod');
    }


    public function confirm(Request $request, $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);

            // Jika status pembayaran sudah dikonfirmasi, beri pesan
            if ($order->payment_status == 'paid') {
                return redirect()->route('orders.index')->with('info', 'Pembayaran sudah dikonfirmasi.');
            }

            // Proses pembayaran jika belum dibayar
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing'
            ]);

            // Create notification after payment is confirmed
            Notification::create([
                'user_id' => Auth::id(),
                'title' => 'Pembayaran Berhasil',
                'message' => "Pembayaran untuk pesanan #{$orderId} telah dikonfirmasi",
                'icon_type' => 'credit-card',
                'order_id' => $orderId,
                'is_read' => false
            ]);

            return redirect()->route('orders.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            return redirect()->route('orders.index')->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function confirmPayment(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate request
            $validated = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'payment_method' => 'required|string',
                'proof_of_payment' => 'required|image|max:2048',
                'amount' => 'required|numeric'
            ]);

            // Process payment proof upload
            if ($request->hasFile('proof_of_payment')) {
                $path = $request->file('proof_of_payment')->store('payment_proofs', 'public');
            }

            // Create payment record
            $payment = Payment::create([
                'user_id' => auth()->id(),
                'order_id' => $validated['order_id'],
                'payment_method' => $validated['payment_method'],
                'amount' => $validated['amount'],
                'status' => 'pending_verification',
                'proof_of_payment' => $path ?? null,
                'payment_date' => now()
            ]);

            // Update order status
            $order = Order::find($validated['order_id']);
            $order->update([
                'payment_status' => 'pending_verification',
                'status' => 'processing'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil dikonfirmasi, menunggu verifikasi admin',
                'payment_id' => $payment->id
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showBca($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('payments.bca', compact('order'));
    }

    public function showDana($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('payments.dana', compact('order'));
    }

    public function showGopay($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('payments.gopay', compact('order'));
    }

    public function showCod($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('payments.cod', compact('order'));
    }

    public function showConfirmation($method, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $paymentMethod = strtoupper($method);
        
        return view('payments.confirmation', compact('order', 'paymentMethod'));
    }

    public function confirmBcaPayment(Request $request)
{
    try {
        // Validasi data request
        $request->validate([
            'payment_proof' => 'required|image|max:2048', // Memastikan hanya gambar yang diterima
            'total' => 'required|numeric',
            'order_data' => 'required'
        ]);

        DB::beginTransaction();

        // Simpan bukti pembayaran ke storage
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Buat entri transaksi
        $transaksi = Transaksi::create([
            'nama_admin' => 'System',
            'nama_pelanggan' => auth()->user()->name ?? 'Guest',
            'tanggal_transaksi' => now(),
            'id_transaksi' => 'BCA-' . time(),
            'jenis_tindakan' => 'Pembayaran BCA',
            'deskripsi_tindakan' => 'Pembayaran via BCA',
            'total_harga' => $request->total,
            'status_transaksi' => 'Menunggu Konfirmasi',
            'bukti_pembayaran' => $path // Menyimpan path bukti pembayaran
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfirmasi'
        ]);

    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Payment Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
        ], 500);
    }
}

public function confirmDanaPayment(Request $request)
{
    try {
        // Validasi data request
        $request->validate([
            'payment_proof' => 'required|image|max:2048',
            'total' => 'required|numeric',
            'order_data' => 'required'
        ]);

        DB::beginTransaction();

        // Simpan bukti pembayaran ke storage
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Buat entri transaksi
        $transaksi = Transaksi::create([
            'nama_admin' => 'System',
            'nama_pelanggan' => auth()->user()->name ?? 'Guest',
            'tanggal_transaksi' => now(),
            'id_transaksi' => 'DANA-' . time(),
            'jenis_tindakan' => 'Pembayaran DANA',
            'deskripsi_tindakan' => 'Pembayaran via DANA',
            'total_harga' => $request->total,
            'status_transaksi' => 'Menunggu Konfirmasi',
            'bukti_pembayaran' => $path
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfirmasi'
        ]);

    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Payment Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
        ], 500);
    }
}

public function confirmGopayPayment(Request $request)
{
    try {
        // Validasi data request
        $request->validate([
            'payment_proof' => 'required|image|max:2048',
            'total' => 'required|numeric',
            'order_data' => 'required'
        ]);

        DB::beginTransaction();

        // Simpan bukti pembayaran ke storage
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Buat entri transaksi
        $transaksi = Transaksi::create([
            'nama_admin' => 'System',
            'nama_pelanggan' => auth()->user()->name ?? 'Guest',
            'tanggal_transaksi' => now(),
            'id_transaksi' => 'GOPAY-' . time(),
            'jenis_tindakan' => 'Pembayaran GOPAY',
            'deskripsi_tindakan' => 'Pembayaran via GOPAY',
            'total_harga' => $request->total,
            'status_transaksi' => 'Menunggu Konfirmasi',
            'bukti_pembayaran' => $path
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfirmasi'
        ]);

    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Payment Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
        ], 500);
    }
}

public function confirmCodPayment(Request $request)
{
    try {
        // Validasi data request
        $request->validate([
            'payment_proof' => 'required|image|max:2048',
            'total' => 'required|numeric',
            'order_data' => 'required',
            'dp_amount' => 'required|numeric'
        ]);

        DB::beginTransaction();

        // Simpan bukti pembayaran DP ke storage
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Buat entri transaksi untuk DP
        $transaksi = Transaksi::create([
            'nama_admin' => 'System',
            'nama_pelanggan' => auth()->user()->name ?? 'Guest',
            'tanggal_transaksi' => now(),
            'id_transaksi' => 'COD-DP-' . time(),
            'jenis_tindakan' => 'Down Payment COD',
            'deskripsi_tindakan' => 'Pembayaran DP untuk pesanan COD',
            'total_harga' => $request->dp_amount,
            'status_transaksi' => 'Menunggu Konfirmasi',
            'bukti_pembayaran' => $path
        ]);

        // Buat entri transaksi untuk sisa pembayaran
        $transaksiSisa = Transaksi::create([
            'nama_admin' => 'System',
            'nama_pelanggan' => auth()->user()->name ?? 'Guest',
            'tanggal_transaksi' => now(),
            'id_transaksi' => 'COD-' . time(),
            'jenis_tindakan' => 'Sisa Pembayaran COD',
            'deskripsi_tindakan' => 'Sisa pembayaran COD yang harus dibayar saat pengiriman',
            'total_harga' => $request->total - $request->dp_amount,
            'status_transaksi' => 'Menunggu Pembayaran',
            'bukti_pembayaran' => null
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran DP berhasil dikonfirmasi'
        ]);

    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Payment Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
        ], 500);
    }
}
}