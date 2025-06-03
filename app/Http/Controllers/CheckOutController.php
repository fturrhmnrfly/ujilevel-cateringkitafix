<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\Transaksi;
use App\Models\DaftarPesanan;
use App\Models\NotificationAdmin;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CheckOutController extends Controller
{
    public function index()
    {
        // Get cart items
        $cartItems = session('cart', []);
        
        // Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Initialize variables
        $shipping_cost = 0;
        $selectedPayment = '';
        $selectedShipping = '';
        $delivery_date = '';
        $delivery_time = '';
        $address = '';
        $phone = '';
        $notes = '';

        return view('checkout.index', compact(
            'cartItems',
            'subtotal',
            'shipping_cost',
            'selectedPayment',
            'selectedShipping',
            'delivery_date',
            'delivery_time',
            'address',
            'phone',
            'notes'
        ));
    }

    public function process(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'items' => 'required|array',
            'shipping' => 'required|array',
            'shipping.method' => 'required|string',
            'shipping.address' => 'required|string',
            'shipping.phone' => 'required|string',
            'shipping.notes' => 'nullable|string',
            'shipping.delivery_date' => 'required|date',
            'shipping.delivery_time' => 'required',
            'payment_method' => 'required|string',
            'total' => 'required|numeric',
            'shipping_cost' => 'required|numeric',
            'subtotal' => 'required|numeric'
        ]);

        DB::beginTransaction();
        try {
            // Create checkout record
            $checkout = CheckOut::create([
                'user_id' => Auth::id(),
                'delivery_date' => $validated['shipping']['delivery_date'],
                'delivery_time' => $validated['shipping']['delivery_time'],
                'address' => $validated['shipping']['address'],
                'phone' => $validated['shipping']['phone'],
                'notes' => $validated['shipping']['notes'],
                'subtotal' => $validated['subtotal'],
                'shipping_cost' => $validated['shipping_cost'],
                'total' => $validated['total'],
                'status' => 'pending'
            ]);

        // Generate unique transaction ID
        $transactionId = 'TRX-' . time() . '-' . Str::random(6);

        // Create record in daftar_pesanan
        $daftarPesanan = DaftarPesanan::create([
            'order_id' => 'ORD-' . Str::uuid(),
            'nama_pelanggan' => Auth::user()->name,
            'kategori_pesanan' => 'Online Order',
            'tanggal_pesanan' => now(),
            'jumlah_pesanan' => count($validated['items']),
            'tanggal_pengiriman' => $validated['shipping']['delivery_date'],
            'waktu_pengiriman' => $validated['shipping']['delivery_time'],
            'lokasi_pengiriman' => $validated['shipping']['address'],
            'nomor_telepon' => $validated['shipping']['phone'],
            'pesan' => $validated['shipping']['notes'],
            'opsi_pengiriman' => $validated['shipping']['method'],
            'total_harga' => $validated['total'],
            'status_pengiriman' => 'diproses',
            'status_pembayaran' => 'pending'
        ]);

        // Create transaction record with unique ID
        Transaksi::create([
            'nama_admin' => 'System',
            'nama_pelanggan' => Auth::user()->name, 
            'tanggal_transaksi' => now(),
            'id_transaksi' => $transactionId,
            'jenis_tindakan' => 'Checkout',
            'deskripsi_tindakan' => 'Pesanan baru',
            'total_harga' => $validated['total'],
            'status_transaksi' => 'Pending'
        ]);

        // Create notification for admin
        NotificationAdmin::create([
            'admin_id' => Auth::id(),
            'title' => 'Pesanan baru',
            'message' => "Pesanan #{$transactionId} sedang dalam Proses",
            'image' => 'assets/box.png', 
            'order_id' => $transactionId,
            'is_read' => false
        ]);

        // Add notification
        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Pesanan Berhasil',
            'message' => "Pesanan #{$daftarPesanan->order_id} sedang dalam proses. Total pembayaran: Rp " . number_format($daftarPesanan->total_harga, 0, ',', '.'),
            'icon_type' => 'box',
            'order_id' => $daftarPesanan->order_id,
            'is_read' => false
        ]);
        Log::info('Creating notification', [
            'user_id' => Auth::id(),
            'order_id' => $daftarPesanan->order_id,
            'total' => $validated['total']
        ]);

        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Checkout berhasil'
        ]);

    } catch (\Exception $e) {
        DB::rollback();
        throw $e;
    }
}

public function store(Request $request)
{
    try {
        // Validasi request
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
            'total_harga' => 'required|numeric',
            'items' => 'required|array'
        ]);

        DB::beginTransaction();

        // Simpan pesanan
        $daftarPesanan = DaftarPesanan::create([
            'order_id' => $validated['order_id'],
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'kategori_pesanan' => $validated['kategori_pesanan'],
            'tanggal_pesanan' => $validated['tanggal_pesanan'],
            'jumlah_pesanan' => $validated['jumlah_pesanan'],
            'tanggal_pengiriman' => $validated['tanggal_pengiriman'],
            'waktu_pengiriman' => $validated['waktu_pengiriman'],
            'lokasi_pengiriman' => $validated['lokasi_pengiriman'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'total_harga' => $validated['total_harga'],
            'status_pengiriman' => 'diproses',
            'status_pembayaran' => 'pending'
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Checkout berhasil',
            'order_id' => $daftarPesanan->order_id
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollback();
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $e->errors()
        ], 422);
        
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Checkout Error: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan internal server'
        ], 500);
    }
}
}