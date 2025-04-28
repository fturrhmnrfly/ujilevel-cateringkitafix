<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function updateStatus(Request $request, $id)
{
    try {
        // Validasi input
        $request->validate([
            'status_pengiriman' => 'required|in:diproses,dikirim,diterima,dibatalkan',
            'catatan' => 'nullable|string'
        ]);

        // Cari pesanan
        $pesanan = Pesanan::findOrFail($id);
        
        // Update status
        $pesanan->update([
            'status_pengiriman' => $request->status_pengiriman,
            'catatan' => $request->catatan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diupdate'
        ]);

    } catch (\Exception $e) {
        \Log::error('Error updating order status: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengupdate status: ' . $e->getMessage() 
        ], 500);
    }
}
}