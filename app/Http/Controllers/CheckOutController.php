<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class CheckOutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request)
    {
        try {
            // Log incoming request untuk debugging
            Log::info('Checkout request received:', $request->all());

            // Validasi data yang diterima
            $validated = $request->validate([
                'order_id' => 'required|string|unique:daftar_pesanans,order_id',
                'nama_pelanggan' => 'required|string|max:255',
                'kategori_pesanan' => 'required|string|max:255',
                'tanggal_pesanan' => 'required|date',
                'jumlah_pesanan' => 'required|integer|min:1',
                'tanggal_pengiriman' => 'required|date|after:today',
                'waktu_pengiriman' => 'required',
                'lokasi_pengiriman' => 'required|string',
                'nomor_telepon' => 'required|string|max:20',
                'opsi_pengiriman' => 'required|string|in:self,instant,regular,economy',
                'pesan' => 'nullable|string',
                'total_harga' => 'required|numeric|min:0',
                'items' => 'required|array|min:1'
            ]);

            DB::beginTransaction();

            // Buat pesanan baru dengan user_id otomatis
            $daftarPesanan = DaftarPesanan::create([
                'order_id' => $validated['order_id'],
                'user_id' => Auth::id(), // Tambahkan user_id otomatis
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'kategori_pesanan' => $validated['kategori_pesanan'],
                'tanggal_pesanan' => $validated['tanggal_pesanan'],
                'jumlah_pesanan' => $validated['jumlah_pesanan'],
                'tanggal_pengiriman' => $validated['tanggal_pengiriman'],
                'waktu_pengiriman' => $validated['waktu_pengiriman'],
                'lokasi_pengiriman' => $validated['lokasi_pengiriman'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'opsi_pengiriman' => $validated['opsi_pengiriman'],
                'pesan' => $validated['pesan'],
                'total_harga' => $validated['total_harga'],
                'status_pengiriman' => 'diproses',
                'status_pembayaran' => 'pending'
            ]);

            DB::commit();

            NotificationService::createOrderNotification($daftarPesanan->id, Auth::id());

            Log::info('Order created successfully:', [
                'order_id' => $daftarPesanan->order_id,
                'user_id' => $daftarPesanan->user_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'order_id' => $daftarPesanan->order_id,
                'user_id' => $daftarPesanan->user_id
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
            Log::error('Validation Error:', $e->errors());
            
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }
}