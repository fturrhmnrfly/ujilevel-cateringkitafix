<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaMakanan;

class KelolaMakananController extends Controller
{
    public function index()
    {
        $makanan = KelolaMakanan::all();
        return view('admin.kelolamakanan.home', compact('makanan'));
    }

    public function create()
    {
        return view('admin.kelolamakanan.create');
    }
}
