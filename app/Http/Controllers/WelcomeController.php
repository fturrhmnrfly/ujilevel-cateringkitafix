<?php

namespace App\Http\Controllers;

use App\Models\KelolaMakanan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $menus = KelolaMakanan::all();
        return view('welcome', compact('menus'));
    }
}
