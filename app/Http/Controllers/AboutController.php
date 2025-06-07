<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Ambil data tentang kami dari database
        $tentangKami = TentangKami::latest()->first();
           
        return view('About.index', compact('tentangKami'));
    }
}
