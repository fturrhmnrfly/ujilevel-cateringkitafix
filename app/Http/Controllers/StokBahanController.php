<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBahan;

class StokBahanController extends Controller
{
    public function index()
    {
        $stokbahans = StokBahan::all();
        return view('admin.stokbahan.home', compact('stokbahans'));
    }

    public function create()
    {
        return view('admin.stokbahan.create');
    }
}
