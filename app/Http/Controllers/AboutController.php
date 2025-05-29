<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $tentangKami = TentangKami::latest()->first();
        return view('About.index', compact('tentangKami'));
    }
}
