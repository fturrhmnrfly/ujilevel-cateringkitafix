<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuNasiBoxController extends Controller
{
    public function index()
    {
        $menuItems = [
            1 => [
                'id' => 1,
                'image' => 'assets/paketassets1.png',
                'nama_produk' => 'Paket Nasi Box Premium A',
                'deskripsi' => 'Nasi putih, Ayam Goreng, Capcay, Mie Goreng, Telur Balado dengan nasi yang pulen dan lauk yang menggugah selera',
                'price' => 35000
            ],
            2 => [
                'id' => 2,
                'image' => 'assets/paketnasikuning.png',
                'nama_produk' => 'Paket nasi kuning  ayam premium',
                'deskripsi' => 'Nasi kuning, ayam goreng, kentang , Mie Goreng, selada, tempe orek',
                'price' => 35000
            ],
            3 => [
                'id' => 3,
                'image' => 'assets/nasikotakpremium2.png',
                'nama_produk' => 'Paket Nasi Box Premium C',
                'deskripsi' => 'Nasi putih, Ayam Goreng, daging cincang, tempe orak arik, sambal, lalapan segar pilihan',
                'price' => 30000
            ],
            4 => [
                'id' => 4,
                'image' => 'assets/nasikotakpremium3.png',
                'nama_produk' => 'Paket Nasi Box Premium D',
                'deskripsi' => 'Nasi putih, daging sapi, sate, naget, sayur, telur kuning, kacang, sambal saus dengan racikan bumbu spesial',
                'price' => 40000
            ],
            5 => [
                'id' => 5,
                'image' => 'assets/paketnasiayamdanrendang.png',
                'nama_produk' => 'Paket Nasi ayam  dan rendang spesial',
                'deskripsi' => 'Nasi kecap, udang, chicken, sayur dengan cita rasa Thailand yang autentik',
                'price' => 40000
            ],
            6 => [
                'id' => 6,
                'image' => 'assets/paketnasiikan.png',
                'nama_produk' => 'Paket Nasi ikan premium',
                'deskripsi' => 'Nasi putih, ikan emas , tempe, tahu dan sambal ',
                'price' => 25000
            ],
        ];

        return view('menunasibox.index', compact('menuItems'));
    }

    public function show($id)
    {
        $menuItems = [
            1 => [
                'id' => 1,
                'image' => 'assets/paketassets1.png',
                'nama_produk' => 'Paket Nasi Box Premium A',
                'deskripsi' => 'Nasi putih, Ayam Goreng, Capcay, Mie Goreng, Telur Balado dengan nasi yang pulen dan lauk yang menggugah selera',
                'price' => 35000
            ],
            2 => [
                'id' => 2,
                'image' => 'assets/paketnasikuning.png',
                'nama_produk' => 'Paket nasi kuning  ayam premium',
                'deskripsi' => 'Nasi kuning, ayam goreng, kentang , Mie Goreng, selada, tempe orek',
                'price' => 35000
            ],
            3 => [
                'id' => 3,
                'image' => 'assets/nasikotakpremium2.png',
                'nama_produk' => 'Paket Nasi Box Premium C',
                'deskripsi' => 'Nasi putih, Ayam Goreng, daging cincang, tempe orak arik, sambal, lalapan segar pilihan',
                'price' => 30000
            ],
            4 => [
                'id' => 4,
                'image' => 'assets/nasikotakpremium3.png',
                'nama_produk' => 'Paket Nasi Box Premium D',
                'deskripsi' => 'Nasi putih, daging sapi, sate, naget, sayur, telur kuning, kacang, sambal saus dengan racikan bumbu spesial',
                'price' => 40000
            ],
            5 => [
                'id' => 5,
                'image' => 'assets/paketnasiayamdanrendang.png',
                'nama_produk' => 'Paket Nasi ayam  dan rendang spesial',
                'deskripsi' => 'Nasi kecap, udang, chicken, sayur dengan cita rasa Thailand yang autentik',
                'price' => 40000
            ],
            6 => [
                'id' => 6,
                'image' => 'assets/paketnasiikan.png',
                'nama_produk' => 'Paket Nasi ikan premium',
                'deskripsi' => 'Nasi putih, ikan emas , tempe, tahu dan sambal ',
                'price' => 25000
            ],
        ];

        if (!isset($menuItems[$id])) {
            abort(404);
        }

        $menu = (object)$menuItems[$id];
        return view('menunasibox.show', compact('menu'));
    }
}