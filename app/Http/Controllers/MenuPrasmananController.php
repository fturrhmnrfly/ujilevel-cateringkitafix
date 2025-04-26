<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuPrasmananController extends Controller
{
    public function index()
    {
        $menuItems = [
            [
                'id' => 1,
                'image' => 'assets/homeassets3.jpg',
                'nama_produk' => 'Ayam Geprek',
                'deskripsi' => 'Ayam goreng crispy yang digeprek dengan sambal pedas special',
                'price' => 12000
            ],
            [
                'id' => 2,
                'image' => 'assets/homeassets6.jpg',
                'nama_produk' => 'Ayam Kecap',
                'deskripsi' => 'Ayam yang dimasak dengan kecap manis dan bumbu rempah pilihan',
                'price' => 9000
            ],
            // Add other menu items...
        ];

        return view('menuprasmanan.index', compact('menuItems'));
    }

    public function show($id)
    {
        $menuItems = [
            1 => [
                'id' => 1,
                'image' => 'assets/homeassets3.jpg',
                'nama_produk' => 'Ayam Geprek',
                'deskripsi' => 'Ayam goreng crispy yang digeprek dengan sambal pedas special. Disajikan dengan lalapan segar.',
                'price' => 12000
            ],
            2 => [
                'id' => 2,
                'image' => 'assets/homeassets6.jpg',
                'nama_produk' => 'Ayam Kecap',
                'deskripsi' => 'Ayam yang dimasak dengan kecap manis dan bumbu rempah pilihan. Memiliki rasa manis gurih yang khas.',
                'price' => 9000
            ],
            3 => [
                'id' => 3,
                'image' => 'assets/ikanbunjaergulai.png',
                'nama_produk' => 'Ikan Bunjer Gulai',
                'deskripsi' => 'Ikan bunjer segar yang dimasak dengan kuah gulai kental dan rempah pilihan. Kaya akan rasa dan aroma rempah.',
                'price' => 10000
            ],
            4 => [
                'id' => 4,
                'image' => 'assets/cumibalado.png',
                'nama_produk' => 'Cumi Balado',
                'deskripsi' => 'Cumi segar yang dimasak dengan sambal balado pedas. Tekstur cumi yang empuk dengan bumbu yang meresap.',
                'price' => 15000
            ],
            5 => [
                'id' => 5,
                'image' => 'assets/homeassets5.jpg',
                'nama_produk' => 'Ikan Goreng',
                'deskripsi' => 'Ikan segar pilihan yang digoreng dengan bumbu rempah tradisional. Renyah di luar, lembut di dalam.',
                'price' => 20000
            ],
            6 => [
                'id' => 6,
                'image' => 'assets/kentangbalado.png',
                'nama_produk' => 'Kentang Balado',
                'deskripsi' => 'Kentang yang digoreng garing dan dimasak dengan sambal balado. Renyah dan pedas menggugah selera.',
                'price' => 8000
            ],
            7 => [
                'id' => 7,
                'image' => 'assets/tempeorek.png',
                'nama_produk' => 'Tempe Orek',
                'deskripsi' => 'Tempe yang diiris tipis dan dimasak dengan bumbu orek manis. Renyah dan memiliki rasa manis gurih.',
                'price' => 5000
            ],
            8 => [
                'id' => 8,
                'image' => 'assets/ayamgoreng.png',
                'nama_produk' => 'Ayam Goreng',
                'deskripsi' => 'Ayam yang digoreng dengan bumbu rempah special. Renyah di luar dan juicy di dalam.',
                'price' => 8000
            ],
            9 => [
                'id' => 9,
                'image' => 'assets/homeassets4.jpg',
                'nama_produk' => 'Telur Balado',
                'deskripsi' => 'Telur yang digoreng dan dimasak dengan sambal balado pedas. Protein yang lezat dengan bumbu yang meresap.',
                'price' => 6000
            ]
        ];

        if (!isset($menuItems[$id])) {
            abort(404);
        }

        $menu = (object)$menuItems[$id];
        return view('menuprasmanan.show', compact('menu'));
    }
}
