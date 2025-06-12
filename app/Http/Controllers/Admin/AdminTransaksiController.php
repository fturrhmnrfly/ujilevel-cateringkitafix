<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\DaftarPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // ✅ TAMBAHKAN IMPORT INI ✅

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::orderBy('tanggal_transaksi', 'desc')->get();

        
        // Ensure dates are Carbon instances
        $transaksis->transform(function($transaksi) {
            if (!$transaksi->tanggal_transaksi instanceof \DateTime) {
                $transaksi->tanggal_transaksi = Carbon::parse($transaksi->tanggal_transaksi);
            }
            return $transaksi;
        });

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            Log::info('Update transaction status request', [
                'transaction_id' => $id,
                'request_data' => $request->all(),
                'admin_id' => Auth::id()
            ]);

            // Find transaction
            $transaksi = Transaksi::find($id);
            if (!$transaksi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404);
            }

            // Validate request
            $validated = $request->validate([
                'status_transaksi' => 'required|string|in:Berhasil,Ditolak',
                'alasan_penolakan' => 'nullable|string|max:1000',
                'deskripsi_tindakan' => 'nullable|string|max:1000'
            ]);

            // Start database transaction
            DB::beginTransaction();

            // Prepare update data for transaction
            $updateData = [
                'status_transaksi' => $validated['status_transaksi'],
                'updated_at' => now()
            ];

            // If rejected, update description
            if ($validated['status_transaksi'] === 'Ditolak' && !empty($validated['alasan_penolakan'])) {
                $updateData['deskripsi_tindakan'] = $validated['alasan_penolakan'];
            }

            // Update transaction
            $transaksi->update($updateData);

            // ✅ UPDATE STATUS PEMBAYARAN DI DAFTAR_PESANANS ✅
            $this->updateRelatedOrderPaymentStatus($transaksi, $validated['status_transaksi']);

            DB::commit();

            Log::info('Transaction status updated successfully', [
                'transaction_id' => $id,
                'old_status' => $transaksi->getOriginal('status_transaksi'),
                'new_status' => $validated['status_transaksi'],
                'admin_id' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status transaksi berhasil diperbarui',
                'data' => [
                    'id' => $transaksi->id,
                    'status_transaksi' => $transaksi->status_transaksi,
                    'deskripsi_tindakan' => $transaksi->deskripsi_tindakan,
                    'updated_at' => $transaksi->updated_at->format('Y-m-d H:i:s')
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . collect($e->errors())->flatten()->first(),
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating transaction status', [
                'transaction_id' => $id,
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * ✅ UPDATE STATUS PEMBAYARAN DI DAFTAR_PESANANS BERDASARKAN TRANSAKSI ✅
     */
    private function updateRelatedOrderPaymentStatus($transaksi, $newTransactionStatus)
    {
        try {
            Log::info('Updating related order payment status', [
                'transaction_id' => $transaksi->id,
                'transaction_id_transaksi' => $transaksi->id_transaksi,
                'customer_name' => $transaksi->nama_pelanggan,
                'new_transaction_status' => $newTransactionStatus
            ]);

            // Mapping status transaksi ke status pembayaran
            $paymentStatusMapping = [
                'Berhasil' => 'paid',
                'Ditolak' => 'failed'
            ];

            $newPaymentStatus = $paymentStatusMapping[$newTransactionStatus] ?? null;

            if (!$newPaymentStatus) {
                Log::warning('No payment status mapping found', [
                    'transaction_status' => $newTransactionStatus
                ]);
                return;
            }

            // ✅ PERBAIKAN: IDENTIFIKASI JENIS TRANSAKSI COD ✅
            $transactionId = $transaksi->id_transaksi;
            $isCodTransaction = str_contains($transactionId, 'COD-');
            $isCodDpTransaction = str_contains($transactionId, 'COD-DP-');
            
            Log::info('Transaction type analysis', [
                'transaction_id' => $transactionId,
                'is_cod' => $isCodTransaction,
                'is_cod_dp' => $isCodDpTransaction
            ]);

            // ✅ LOGIC KHUSUS UNTUK COD ✅
            if ($isCodTransaction) {
                // Untuk COD, hanya update payment status jika:
                // 1. Ini adalah transaksi DP yang disetujui, ATAU
                // 2. Ini adalah transaksi sisa yang disetujui
                
                if ($isCodDpTransaction && $newTransactionStatus === 'Berhasil') {
                    // ✅ COD DP APPROVED - Update payment status ke 'paid' ✅
                    Log::info('Processing COD DP approval', [
                        'transaction_id' => $transaksi->id,
                        'base_order_id' => str_replace('COD-DP-', '', $transactionId),
                        'customer_name' => $transaksi->nama_pelanggan
                    ]);
                    
                    $this->updateCodRelatedOrders($transaksi, 'paid');
                } elseif (!$isCodDpTransaction) {
                    // ✅ COD SISA PAYMENT - Update based on status ✅
                    Log::info('Processing COD Sisa payment', [
                        'transaction_id' => $transaksi->id,
                        'new_payment_status' => $newPaymentStatus
                    ]);
                    
                    $this->updateCodRelatedOrders($transaksi, $newPaymentStatus);
                }
            } else {
                // ✅ NON-COD TRANSACTIONS - Original logic ✅
                $this->updateNonCodRelatedOrders($transaksi, $newPaymentStatus);
            }

        } catch (\Exception $e) {
            Log::error('Error updating related order payment status', [
                'transaction_id' => $transaksi->id,
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * ✅ UPDATE ORDERS UNTUK COD TRANSACTIONS - PERBAIKAN PENCARIAN ✅
     */
    private function updateCodRelatedOrders($transaksi, $newPaymentStatus)
    {
        // Extract base order ID dari transaction ID
        $transactionId = $transaksi->id_transaksi;
        $baseOrderId = null;
        $isCodDp = false;
        $isCodSisa = false;
        
        if (str_contains($transactionId, 'COD-DP-')) {
            // COD-DP-1749720663 -> 1749720663
            $baseOrderId = str_replace('COD-DP-', '', $transactionId);
            $isCodDp = true;
        } elseif (str_contains($transactionId, 'COD-')) {
            // COD-1749720663 -> 1749720663
            $baseOrderId = str_replace('COD-', '', $transactionId);
            $isCodSisa = true;
        }
        
        if (!$baseOrderId) {
            Log::warning('Could not extract base order ID from COD transaction', [
                'transaction_id' => $transactionId
            ]);
            return;
        }

        // ✅ STRATEGI PENCARIAN BERLAPIS ✅
        $relatedOrders = collect();
        
        // Strategi 1: Pencarian berdasarkan order_id pattern
        $ordersByPattern = DaftarPesanan::where('nama_pelanggan', $transaksi->nama_pelanggan)
                                   ->where(function($query) use ($baseOrderId) {
                                       $query->where('order_id', 'LIKE', "%{$baseOrderId}%")
                                             ->orWhere('order_id', 'LIKE', "%COD%{$baseOrderId}%");
                                   })
                                   ->get();
    
        $relatedOrders = $relatedOrders->merge($ordersByPattern);
    
        // Strategi 2: Pencarian berdasarkan timestamp (jika strategi 1 gagal)
        if ($relatedOrders->isEmpty()) {
            $ordersbyTime = DaftarPesanan::where('nama_pelanggan', $transaksi->nama_pelanggan)
                                    ->whereBetween('created_at', [
                                        Carbon::parse($transaksi->tanggal_transaksi)->subMinutes(30),
                                        Carbon::parse($transaksi->tanggal_transaksi)->addMinutes(30)
                                    ])
                                    ->where('status_pembayaran', 'pending')
                                    ->get();
        
            $relatedOrders = $relatedOrders->merge($ordersbyTime);
        }
    
        // Strategi 3: Pencarian berdasarkan total harga untuk DP (35% dari total)
        if ($isCodDp && $relatedOrders->isEmpty()) {
            $dpAmount = $transaksi->total_harga;
            $estimatedTotal = $dpAmount / 0.35; // Estimasi total dari DP 35%
            $tolerance = $estimatedTotal * 0.1; // Toleransi 10%
        
            $ordersByAmount = DaftarPesanan::where('nama_pelanggan', $transaksi->nama_pelanggan)
                                      ->whereBetween('total_harga', [
                                          $estimatedTotal - $tolerance,
                                          $estimatedTotal + $tolerance
                                      ])
                                      ->where('status_pembayaran', 'pending')
                                      ->get();
        
            $relatedOrders = $relatedOrders->merge($ordersByAmount);
        }
    
        // Remove duplicates
        $relatedOrders = $relatedOrders->unique('id');

        Log::info('COD related orders search results', [
            'base_order_id' => $baseOrderId,
            'transaction_id' => $transactionId,
            'customer_name' => $transaksi->nama_pelanggan,
            'transaction_date' => $transaksi->tanggal_transaksi,
            'orders_found' => $relatedOrders->count(),
            'found_orders' => $relatedOrders->pluck('order_id')->toArray(),
            'is_dp' => $isCodDp,
            'is_sisa' => $isCodSisa,
            'search_strategies_used' => [
                'pattern_match' => $ordersByPattern->count(),
                'time_based' => isset($ordersbyTime) ? $ordersbyTime->count() : 0,
                'amount_based' => isset($ordersByAmount) ? $ordersByAmount->count() : 0
            ]
        ]);

        $updatedOrdersCount = 0;

        foreach ($relatedOrders as $order) {
            // ✅ LOGIC UPDATE BERDASARKAN JENIS TRANSAKSI COD ✅
            if ($isCodDp && $newPaymentStatus === 'paid') {
                // ✅ COD DP APPROVED - Update payment status ke 'paid' ✅
                if ($order->status_pembayaran === 'pending') {
                    $oldPaymentStatus = $order->status_pembayaran;
                    
                    $success = $order->update([
                        'status_pembayaran' => 'paid',
                        'updated_at' => now()
                    ]);

                    if ($success) {
                        $updatedOrdersCount++;

                        Log::info('COD DP order payment status updated successfully', [
                            'order_id' => $order->id,
                            'order_number' => $order->order_id,
                            'old_payment_status' => $oldPaymentStatus,
                            'new_payment_status' => 'paid',
                            'transaction_id' => $transaksi->id,
                            'customer_name' => $order->nama_pelanggan
                        ]);
                    } else {
                        Log::warning('Failed to update COD DP order payment status', [
                            'order_id' => $order->id,
                            'order_number' => $order->order_id
                        ]);
                    }
                }
                
                // ✅ UPDATE STATUS TRANSAKSI SISA MENJADI 'MENUNGGU KONFIRMASI' ✅
                $this->updateCodSisaTransactionStatus($baseOrderId, $transaksi->nama_pelanggan);
                
            } elseif ($isCodSisa) {
                // ✅ COD SISA PAYMENT - Update final status ✅
                if ($order->status_pembayaran === 'paid') { // Hanya update jika status payment sudah paid (dari DP)
                    $oldPaymentStatus = $order->status_pembayaran;
                    
                    // Update final payment status based on sisa payment result
                    $finalPaymentStatus = $newPaymentStatus === 'paid' ? 'paid' : 'failed';
                    
                    $success = $order->update([
                        'status_pembayaran' => $finalPaymentStatus,
                        'updated_at' => now()
                    ]);

                    if ($success) {
                        $updatedOrdersCount++;

                        Log::info('COD Sisa order payment status updated successfully', [
                            'order_id' => $order->id,
                            'order_number' => $order->order_id,
                            'old_payment_status' => $oldPaymentStatus,
                            'new_payment_status' => $finalPaymentStatus,
                            'transaction_id' => $transaksi->id
                        ]);
                    } else {
                        Log::warning('Failed to update COD Sisa order payment status', [
                            'order_id' => $order->id,
                            'order_number' => $order->order_id
                        ]);
                    }
                }
            }
        }

        Log::info('COD related orders update completed', [
            'transaction_id' => $transaksi->id,
            'total_orders_found' => $relatedOrders->count(),
            'orders_updated' => $updatedOrdersCount,
            'new_payment_status' => $newPaymentStatus,
            'success_rate' => $relatedOrders->count() > 0 ? ($updatedOrdersCount / $relatedOrders->count()) * 100 : 0
        ]);
}

/**
 * ✅ PERBAIKAN: UPDATE STATUS TRANSAKSI COD SISA SETELAH DP DISETUJUI ✅
 */
private function updateCodSisaTransactionStatus($baseOrderId, $customerName)
{
    try {
        // ✅ PENCARIAN YANG LEBIH ROBUST ✅
        $codSisaTransaction = Transaksi::where('nama_pelanggan', $customerName)
                                      ->where(function($query) use ($baseOrderId) {
                                          $query->where('id_transaksi', 'COD-' . $baseOrderId)
                                                ->orWhere('id_transaksi', 'LIKE', 'COD-' . $baseOrderId . '%');
                                      })
                                      ->where('jenis_tindakan', 'Sisa Pembayaran COD')
                                      ->where('status_transaksi', '!=', 'Berhasil') // Hindari update yang sudah selesai
                                      ->first();
        
        if ($codSisaTransaction) {
            $oldStatus = $codSisaTransaction->status_transaksi;
            
            // ✅ PASTIKAN STATUS BERUBAH KE "MENUNGGU KONFIRMASI" ✅
            $updated = $codSisaTransaction->update([
                'status_transaksi' => 'Menunggu Konfirmasi',
                'deskripsi_tindakan' => 'Menunggu konfirmasi pelunasan dari pelanggan saat pengiriman',
                'updated_at' => now()
            ]);
            
            if ($updated) {
                Log::info('COD Sisa transaction status updated successfully', [
                    'sisa_transaction_id' => $codSisaTransaction->id,
                    'old_status' => $oldStatus,
                    'new_status' => 'Menunggu Konfirmasi',
                    'base_order_id' => $baseOrderId,
                    'customer_name' => $customerName,
                    'updated' => $updated
                ]);
            } else {
                Log::warning('Failed to update COD Sisa transaction status', [
                    'sisa_transaction_id' => $codSisaTransaction->id,
                    'base_order_id' => $baseOrderId
                ]);
            }
        } else {
            Log::warning('COD Sisa transaction not found for update', [
                'base_order_id' => $baseOrderId,
                'customer_name' => $customerName,
                'search_patterns' => [
                    'COD-' . $baseOrderId,
                    'COD-' . $baseOrderId . '%'
                ]
            ]);
            
            // ✅ FALLBACK: CARI DENGAN TIMESTAMP YANG MIRIP ✅
            $this->findAndUpdateCodSisaByTimestamp($baseOrderId, $customerName);
        }
    } catch (\Exception $e) {
        Log::error('Error updating COD Sisa transaction status', [
            'base_order_id' => $baseOrderId,
            'customer_name' => $customerName,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
}

/**
 * ✅ FALLBACK METHOD: CARI COD SISA BERDASARKAN TIMESTAMP ✅
 */
private function findAndUpdateCodSisaByTimestamp($baseOrderId, $customerName)
{
    try {
        // Cari COD Sisa dengan timestamp yang dekat dengan DP
        $codSisaTransactions = Transaksi::where('nama_pelanggan', $customerName)
                                       ->where('jenis_tindakan', 'Sisa Pembayaran COD')
                                       ->where('status_transaksi', '!=', 'Berhasil')
                                       ->where('created_at', '>=', now()->subMinutes(30)) // Dalam 30 menit terakhir
                                       ->get();
        
        foreach ($codSisaTransactions as $transaction) {
            // Extract timestamp dari ID transaksi
            if (preg_match('/COD-(\d+)/', $transaction->id_transaksi, $matches)) {
                $transactionTimestamp = $matches[1];
                
                // Jika timestamp cocok dengan baseOrderId
                if (abs($transactionTimestamp - $baseOrderId) < 5) { // Toleransi 5 detik
                    $transaction->update([
                        'status_transaksi' => 'Menunggu Konfirmasi',
                        'deskripsi_tindakan' => 'Menunggu konfirmasi pelunasan dari pelanggan saat pengiriman',
                        'updated_at' => now()
                    ]);
                    
                    Log::info('COD Sisa found and updated via timestamp matching', [
                        'transaction_id' => $transaction->id,
                        'transaction_id_transaksi' => $transaction->id_transaksi,
                        'base_order_id' => $baseOrderId,
                        'timestamp_diff' => abs($transactionTimestamp - $baseOrderId)
                    ]);
                    break;
                }
            }
        }
    } catch (\Exception $e) {
        Log::error('Error in fallback COD Sisa update', [
            'error' => $e->getMessage()
        ]);
    }
}

    /**
     * ✅ UPDATE ORDERS UNTUK NON-COD TRANSACTIONS ✅
     */
    private function updateNonCodRelatedOrders($transaksi, $newPaymentStatus)
    {
        // Original logic untuk non-COD transactions
        $ordersQuery = DaftarPesanan::where('nama_pelanggan', $transaksi->nama_pelanggan)
                                    ->where('total_harga', $transaksi->total_harga);

        // Tambahan filter berdasarkan tanggal jika memungkinkan (dalam rentang 7 hari)
        if ($transaksi->tanggal_transaksi) {
            $transactionDate = Carbon::parse($transaksi->tanggal_transaksi);
            $ordersQuery->whereBetween('tanggal_pesanan', [
                $transactionDate->copy()->subDays(7),
                $transactionDate->copy()->addDays(7)
            ]);
        }

        $relatedOrders = $ordersQuery->get();

        if ($relatedOrders->isEmpty()) {
            Log::warning('No related orders found for non-COD transaction', [
                'transaction_id' => $transaksi->id,
                'customer_name' => $transaksi->nama_pelanggan,
                'total_amount' => $transaksi->total_harga
            ]);
            return;
        }

        $updatedOrdersCount = 0;

        foreach ($relatedOrders as $order) {
            // Hanya update jika status pembayaran saat ini adalah 'pending'
            if ($order->status_pembayaran === 'pending') {
                $oldPaymentStatus = $order->status_pembayaran;
                
                $order->update([
                    'status_pembayaran' => $newPaymentStatus,
                    'updated_at' => now()
                ]);

                $updatedOrdersCount++;

                Log::info('Non-COD order payment status updated', [
                    'order_id' => $order->id,
                    'order_number' => $order->order_id,
                    'old_payment_status' => $oldPaymentStatus,
                    'new_payment_status' => $newPaymentStatus,
                    'transaction_id' => $transaksi->id
                ]);
            }
        }

        Log::info('Non-COD related orders update completed', [
            'transaction_id' => $transaksi->id,
            'total_orders_found' => $relatedOrders->count(),
            'orders_updated' => $updatedOrdersCount,
            'new_payment_status' => $newPaymentStatus
        ]);
    }

    public function create()
    {
        return view('admin.transaksi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_admin' => 'required',
            'nama_pelanggan' => 'required',
            'tanggal_transaksi' => 'required|date',
            'id_transaksi' => 'required|unique:transaksis',
            'jenis_tindakan' => 'required',
            'deskripsi_tindakan' => 'required',
            'status_transaksi' => 'required|in:Selesai,Dibatalkan',
        ]);

        Transaksi::create($validated);
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dibuat.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_admin' => 'required',
            'status_transaksi' => 'required|in:Selesai,Dibatalkan,Pending',
            'deskripsi_tindakan' => 'required'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
