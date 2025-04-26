<?php
namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;

class DashboardController extends Controller 
{
    public function index()
    {
        $tentangkamis = TentangKami::all();
        return view('dashboard', compact('tentangkami'));
    }
}
