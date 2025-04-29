<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\Transaksi;
use App\Models\DaftarPesanan; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();
            
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
            DaftarPesanan::create([
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

            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Checkout berhasil'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => 'Gagal memproses checkout: ' . $e->getMessage()
            ], 500);
        }
    }
}