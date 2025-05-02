<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;

class AboutController extends Controller
{
    public function index()
    {
        // Get the latest TentangKami data
        $tentangKami = TentangKami::latest()->first();
        return view('About.index', compact('tentangKami'));
    }
}
