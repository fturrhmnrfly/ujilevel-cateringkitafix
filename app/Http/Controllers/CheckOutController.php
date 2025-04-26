<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
{
    try {
        DB::beginTransaction();

        // Validasi request
        $validated = $request->validate([
            'delivery_date' => 'required|date',
            'delivery_time' => 'required',
            'address' => 'required|string',
            'phone' => 'required|string',
            'notes' => 'nullable|string',
            'subtotal' => 'required|numeric',
            'shipping_cost' => 'required|numeric',
            'total' => 'required|numeric',
            'items' => 'required|array'
        ]);

        // Buat checkout record
$checkout = CheckOut::create([
    'user_id' => Auth::id(),
    'delivery_date' => $validated['delivery_date'],
    'delivery_time' => $validated['delivery_time'],
    'address' => $validated['address'],
    'phone' => $validated['phone'],
    'notes' => $validated['notes'],
    'subtotal' => $validated['subtotal'],
    'shipping_cost' => $validated['shipping_cost'],
    'total' => $validated['total'],
    'status' => 'pending'
]);

// Buat transaksi record
    Transaksi::create([
    'nama_admin' => 'Admin', // atau ambil dari Auth kalau perlu
    'nama_pelanggan' => Auth::user()->name ?? 'Guest', // atau custom
    'tanggal_transaksi' => now(),
    'id_transaksi' => 'ORD-' . strtoupper(uniqid()), // buat ID unik
    'jenis_tindakan' => 'Checkout Produk', // bisa disesuaikan
    'deskripsi_tindakan' => 'Pelanggan melakukan checkout.',
    'total_harga' => $validated['total'],
    'status_transaksi' => 'pending',
    'bukti_pembayaran' => null, // atau default dulu
]);


        // Tambahkan juga ke tabel transaksi admin
        Transaksi::create([
            'nama_admin' => 'System', // atau kosong, nanti admin edit
            'nama_pelanggan' => Auth::user()->name ?? 'Guest', // pastikan user login
            'tanggal_transaksi' => now(),
            'id_transaksi' => '#ORD-' . strtoupper(uniqid()), // bikin kode unik
            'jenis_tindakan' => 'Checkout',
            'deskripsi_tindakan' => 'Pesanan baru dari pelanggan.',
            'total_harga' => $validated['total'],
            'status_transaksi' => 'Menunggu',
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Checkout berhasil',
            'checkout_id' => $checkout->id
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