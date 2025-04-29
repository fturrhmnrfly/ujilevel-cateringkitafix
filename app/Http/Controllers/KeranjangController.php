<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\KeranjangItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();
            
            // Validate input
            $validated = $request->validate([
                'nama_produk' => 'required|string',
                'price' => 'required|numeric',
                'quantity' => 'required|integer|min:1',
                'image' => 'required|string'
            ]);

            // Get or create active cart
            $keranjang = Keranjang::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'status' => 'active'
                ],
                [
                    'total' => 0
                ]
            );

            // Check existing item
            $existingItem = KeranjangItem::where('keranjang_id', $keranjang->id)
                                    ->where('nama_produk', $validated['nama_produk'])
                                    ->first();

            if ($existingItem) {
                // Update quantity if exists
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $validated['quantity']
                ]);
            } else {
                // Create new item
                KeranjangItem::create([
                    'keranjang_id' => $keranjang->id,
                    'nama_produk' => $validated['nama_produk'],
                    'price' => $validated['price'],
                    'quantity' => $validated['quantity'],
                    'image' => $validated['image']
                ]);
            }

            // Update cart total
            $keranjang->update([
                'total' => $keranjang->items->sum(function($item) {
                    return $item->price * $item->quantity;
                })
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => 'Gagal menambahkan ke keranjang: ' . $e->getMessage()
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
            // Cari item di keranjang
            $item = KeranjangItem::findOrFail($id);
            $keranjang = $item->keranjang;
            
            // Hapus item
            $item->delete();

            // Update total keranjang
            $keranjang->update([
                'total' => $keranjang->items->sum(function($item) {
                    return $item->price * $item->quantity;
                })
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus'
            ]);

        } catch (\Exception $e) {
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
}
