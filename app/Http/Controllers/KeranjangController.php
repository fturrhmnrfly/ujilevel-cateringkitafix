<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\KeranjangItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::where('user_id', Auth::id())
                            ->where('status', 'active')
                            ->first();
        
        $cartItems = $keranjang ? $keranjang->items : collect([]);
        return view('keranjang.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'nullable|integer', // Tambahkan validasi untuk id
                'nama_produk' => 'required|string',
                'price' => 'required|numeric',
                'quantity' => 'required|integer|min:1',
                'image' => 'nullable|string',
                'kelola_makanan_id' => 'nullable|integer'
            ]);

            $keranjang = Keranjang::firstOrCreate([
                'user_id' => Auth::id(),
                'status' => 'active'
            ]);

            // Debug: Log data yang diterima
            Log::info('Add to cart data:', $validated);

            // Cari kelola_makanan_id dengan prioritas
            $kelolaMakananId = $validated['kelola_makanan_id'] ?? $validated['id'] ?? null;
            
            if (!$kelolaMakananId) {
                // Fallback: cari berdasarkan nama produk
                $product = \App\Models\KelolaMakanan::where('nama_makanan', $validated['nama_produk'])->first();
                $kelolaMakananId = $product ? $product->id : null;
            }

            Log::info('Final kelola_makanan_id for cart:', ['id' => $kelolaMakananId]);

            $item = KeranjangItem::create([
                'keranjang_id' => $keranjang->id,
                'kelola_makanan_id' => $kelolaMakananId, // Simpan ID ini
                'nama_produk' => $validated['nama_produk'],
                'price' => $validated['price'],
                'quantity' => $validated['quantity'],
                'image' => $validated['image']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil ditambahkan ke keranjang',
                'kelola_makanan_id' => $kelolaMakananId // Debug info
            ]);

        } catch (\Exception $e) {
            Log::error('Add to cart error:', [
                'message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        try {
            $item = KeranjangItem::findOrFail($id);
            $item->update(['quantity' => $request->quantity]);
            
            // Update total keranjang
            $item->keranjang->update([
                'total' => $item->keranjang->items->sum(function($item) {
                    return $item->price * $item->quantity;
                })
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function removeItem($id)
    {
        try {
            // Log untuk debugging
            Log::info('Attempting to delete cart item', ['item_id' => $id, 'user_id' => Auth::id()]);
            
            // Cari item di keranjang dengan validasi user
            $item = KeranjangItem::whereHas('keranjang', function($query) {
                $query->where('user_id', Auth::id());
            })->findOrFail($id);
            
            Log::info('Cart item found', ['item' => $item->toArray()]);
            
            $keranjang = $item->keranjang;
            
            // Hapus item
            $item->delete();
            
            Log::info('Cart item deleted successfully');

            // Update total keranjang jika masih ada items
            if ($keranjang->items()->count() > 0) {
                $newTotal = $keranjang->items->sum(function($item) {
                    return $item->price * $item->quantity;
                });
                
                $keranjang->update(['total' => $newTotal]);
                Log::info('Cart total updated', ['new_total' => $newTotal]);
            } else {
                // Jika tidak ada item lagi, set total ke 0
                $keranjang->update(['total' => 0]);
                Log::info('Cart is now empty, total set to 0');
            }

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Cart item not found', ['item_id' => $id, 'user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ], 404);
            
        } catch (\Exception $e) {
            Log::error('Error deleting cart item', [
                'item_id' => $id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus item: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCartCount()
    {
        try {
            $keranjang = Keranjang::where('user_id', Auth::id())
                                 ->where('status', 'active')
                                 ->first();
            
            if ($keranjang) {
                $items = $keranjang->items;
                $count = $items->sum('quantity');
                
                return response()->json([
                    'success' => true,
                    'count' => $count,
                    'items' => $items
                ]);
            }
            
            return response()->json([
                'success' => true,
                'count' => 0,
                'items' => []
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getCartItems()
    {
        try {
            $keranjang = Keranjang::where('user_id', Auth::id())
                             ->where('status', 'active')
                             ->with(['items.kelolaMakanan']) // Eager load relasi
                             ->first();

            if (!$keranjang || !$keranjang->items) {
                return response()->json(['items' => []]);
            }

            $items = $keranjang->items->map(function ($item) {
                return [
                    'id' => $item->kelola_makanan_id, // Kirim kelola_makanan_id sebagai id
                    'kelola_makanan_id' => $item->kelola_makanan_id, // Kirim juga secara eksplisit
                    'nama_produk' => $item->nama_produk,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'image' => $item->image,
                    'total' => $item->price * $item->quantity
                ];
            });

            return response()->json(['items' => $items]);

        } catch (\Exception $e) {
            Log::error('Get cart items error:', $e->getMessage());
            return response()->json(['items' => []], 500);
        }
    }
}
