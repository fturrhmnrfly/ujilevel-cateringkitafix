<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuPrasmananController extends Controller
{
    public function index()
    {
        return view('menuprasmanan.index');
    }
}
