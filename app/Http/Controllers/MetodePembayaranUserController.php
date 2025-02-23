<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MetodePembayaranUserController extends Controller
{
    public function index() {
        return view('metodepembayaranuser.index');
    }
}
