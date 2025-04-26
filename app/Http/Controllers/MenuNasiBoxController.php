<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuNasiBoxController extends Controller
{
    public function index()
    {
        $menuItems = [
            [
                'id' => 1,
                'image' => 'assets/paketassets1.png',
                'nama_produk' => 'Paket Nasi Box Premium A',
                'deskripsi' => 'Nasi putih, Ayam Goreng, Capcay, Mie Goreng, Telur Balado',
                'price' => 35000
            ],
            [
                'id' => 2,
                'image' => 'assets/paketassets2.png',
                'nama_produk' => 'Paket Nasi Box Premium B',
                'deskripsi' => 'Nasi putih, Ayam Bakar, Tumis Sayur, Tempe Goreng',
                'price' => 35000
            ],
            [
                'id' => 3,
                'image' => 'assets/nasikotakpremium2.png',
                'nama_produk' => 'Paket Nasi Box Premium C',
                'deskripsi' => 'Nasi putih, Ayam Goreng, daging cincang, tempe orak arik, sambal, lalapan',
                'price' => 30000
            ],
            [
                'id' => 4,
                'image' => 'assets/nasikotakpremium3.png',
                'nama_produk' => 'Paket Nasi Box Premium D',
                'deskripsi' => 'Nasi putih, daging sapi, sate, naget, sayur, telur kuning, kacang, sambal saus',
                'price' => 40000
            ],
            [
                'id' => 5,
                'image' => 'assets/nasiboxthailand.png',
                'nama_produk' => 'Paket Nasi Campur Thailand',
                'deskripsi' => 'Nasi kecap, udang, chicken, sayur',
                'price' => 40000
            ],
            [
                'id' => 6,
                'image' => 'assets/nasiboxgeprek.png',
                'nama_produk' => 'Paket Nasi Box Geprek',
                'deskripsi' => 'Nasi putih, Ayam Geprek, Lalapan, Sambal',
                'price' => 25000
            ],
            [
                'id' => 7,
                'image' => 'assets/nasiboxayambakar.png',
                'nama_produk' => 'Paket Nasi Box Ayam Bakar',
                'deskripsi' => 'Nasi Liwet, Ayam Bakar, Tumis Jagung Manis, Telur Ceplok, Sambal',
                'price' => 25000
            ],
            [
                'id' => 8,
                'image' => 'assets/nasiboxayamgoreng.png',
                'nama_produk' => 'Paket Nasi Box Ayam Goreng',
                'deskripsi' => 'Nasi putih, Ayam Goreng Crispy, Sambal Matah, Lalapan',
                'price' => 25000
            ]
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
                'image' => 'assets/paketassets2.png',
                'nama_produk' => 'Paket Nasi Box Premium B',
                'deskripsi' => 'Nasi putih, Ayam Bakar, Tumis Sayur, Tempe Goreng dengan bumbu rempah pilihan yang lezat',
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
                'image' => 'assets/nasikotakthailand.png',
                'nama_produk' => 'Paket Nasi Campur Thailand',
                'deskripsi' => 'Nasi kecap, udang, chicken, sayur dengan cita rasa Thailand yang autentik',
                'price' => 40000
            ],
            6 => [
                'id' => 6,
                'image' => 'assets/nasiboxgeprek.png',
                'nama_produk' => 'Paket Nasi Box Geprek',
                'deskripsi' => 'Nasi putih, Ayam Geprek, Lalapan, Sambal dengan tingkat kepedasan yang bisa disesuaikan',
                'price' => 25000
            ],
            7 => [
                'id' => 7,
                'image' => 'assets/nasiboxayambakar.png',
                'nama_produk' => 'Paket Nasi Box Ayam Bakar',
                'deskripsi' => 'Nasi Liwet, Ayam Bakar, Tumis Jagung Manis, Telur Ceplok, Sambal dengan bumbu bakar special',
                'price' => 25000
            ],
            8 => [
                'id' => 8,
                'image' => 'assets/nasiboxayamgoreng.png',
                'nama_produk' => 'Paket Nasi Box Ayam Goreng',
                'deskripsi' => 'Nasi putih, Ayam Goreng Crispy, Sambal Matah, Lalapan dengan tekstur crispy yang renyah',
                'price' => 25000
            ]
        ];

        if (!isset($menuItems[$id])) {
            abort(404);
        }

        $menu = (object)$menuItems[$id];
        return view('menunasibox.show', compact('menu'));
    }
}