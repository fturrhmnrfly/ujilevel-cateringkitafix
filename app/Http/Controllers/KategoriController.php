<?php

namespace App\Http\Controllers;

use App\Models\MenuNasiBox;
use App\Models\MenuPrasmanan;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // Gabungkan data dari kedua menu
        $nasiBoxMenus = MenuNasiBox::where('status', 'aktif')->get();
        $prasmananMenus = MenuPrasmanan::where('status', 'aktif')->get();

        // Format data untuk view
        $kategoris = collect();
        
        // Format menu nasi box
        foreach ($nasiBoxMenus as $menu) {
            $kategoris->push([
                'id' => $menu->id,
                'nama_kategori' => 'Nasi Box - ' . $menu->nama_menu,
                'deskripsi' => $menu->deskripsi,
                'jumlah_item' => $menu->jumlah_tersedia,
                'type' => 'nasibox'
            ]);
        }

        // Format menu prasmanan
        foreach ($prasmananMenus as $menu) {
            $kategoris->push([
                'id' => $menu->id,
                'nama_kategori' => 'Prasmanan - ' . $menu->nama_menu,
                'deskripsi' => $menu->deskripsi,
                'jumlah_item' => $menu->jumlah_tersedia,
                'type' => 'prasmanan'
            ]);
        }

        return view('admin.kategori.index', compact('kategoris'));
    }

    public function destroy($id)
    {
        // Check if menu exists in nasi box
        $nasiBox = MenuNasiBox::find($id);
        if ($nasiBox) {
            $nasiBox->update(['status' => 'nonaktif']);
            return redirect()->route('admin.kategori.index')->with('success', 'Menu berhasil dihapus');
        }

        // Check if menu exists in prasmanan
        $prasmanan = MenuPrasmanan::find($id);
        if ($prasmanan) {
            $prasmanan->update(['status' => 'nonaktif']);
            return redirect()->route('admin.kategori.index')->with('success', 'Menu berhasil dihapus');
        }

        return redirect()->route('admin.kategori.index')->with('error', 'Menu tidak ditemukan');
    }
}
