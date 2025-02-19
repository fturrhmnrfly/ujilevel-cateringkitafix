<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuNasiBoxController extends Controller
{
    public function index()
    {
        return view('menunasibox.index');
    }
}
