<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPesanan;
use App\Models\KelolaMakanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            Log::info('Checkout request data:', $request->all());
            
            $validated = $request->validate([
                'order_id' => 'required|string',
                'user_id' => 'required|integer',
                'kelola_makanan_id' => 'nullable|integer', // HAPUS exists validation sementara
                'nama_pelanggan' => 'required|string|max:255',
                'kategori_pesanan' => 'required|string',
                'tanggal_pesanan' => 'required|date',
                'jumlah_pesanan' => 'required|integer|min:1',
                'tanggal_pengiriman' => 'required|date',
                'waktu_pengiriman' => 'required|string',
                'lokasi_pengiriman' => 'required|string',
                'nomor_telepon' => 'required|string',
                'pesan' => 'nullable|string',
                'opsi_pengiriman' => 'required|string',
                'total_harga' => 'required|numeric',
                'items' => 'required|array'
            ]);

            DB::beginTransaction();

            // Handle missing kelola_makanan_id dengan debugging
            $kelolaMakananId = $validated['kelola_makanan_id'] ?? null;
            
            Log::info('Initial kelola_makanan_id:', ['id' => $kelolaMakananId]);
            
            // Jika kelola_makanan_id masih null, coba ambil dari items array
            if (!$kelolaMakananId && !empty($validated['items'])) {
                $firstItem = $validated['items'][0];
                Log::info('First item from items array:', $firstItem);
                
                $kelolaMakananId = $firstItem['id'] ?? 
                                 $firstItem['kelola_makanan_id'] ?? 
                                 $firstItem['menu_id'] ?? 
                                 $firstItem['product_id'] ??
                                 null;
                                 
                Log::info('Extracted kelola_makanan_id from items:', ['id' => $kelolaMakananId]);
            }
            
            // Validasi manual kelola_makanan_id jika ada
            if ($kelolaMakananId) {
                $makananExists = KelolaMakanan::find($kelolaMakananId);
                if (!$makananExists) {
                    Log::warning('kelola_makanan_id not found in database:', ['id' => $kelolaMakananId]);
                    $kelolaMakananId = null; // Set ke null jika tidak ditemukan
                }
            }

            $daftarPesanan = DaftarPesanan::create([
                'order_id' => $validated['order_id'],
                'user_id' => Auth::id(),
                'kelola_makanan_id' => $kelolaMakananId, // Bisa null
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'kategori_pesanan' => $validated['kategori_pesanan'],
                'tanggal_pesanan' => $validated['tanggal_pesanan'],
                'jumlah_pesanan' => $validated['jumlah_pesanan'],
                'tanggal_pengiriman' => $validated['tanggal_pengiriman'],
                'waktu_pengiriman' => $validated['waktu_pengiriman'],
                'lokasi_pengiriman' => $validated['lokasi_pengiriman'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'pesan' => $validated['pesan'],
                'opsi_pengiriman' => $validated['opsi_pengiriman'],
                'total_harga' => $validated['total_harga'],
                'status_pengiriman' => 'diproses',
                'status_pembayaran' => 'pending'
            ]);

            DB::commit();
            
            Log::info('Order created successfully:', [
                'order_id' => $daftarPesanan->order_id,
                'kelola_makanan_id' => $kelolaMakananId
            ]);
            
            return response()->json(['success' => true, 'order_id' => $daftarPesanan->order_id]);
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}