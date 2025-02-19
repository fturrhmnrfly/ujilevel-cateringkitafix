<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormulirPesananController extends Controller
{
    public function index()
    {
        return view('formulirpesanan.index');
    }
}
