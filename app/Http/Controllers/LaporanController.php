<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $laporans = laporan::when($search, function ($query, $search) {
        return $query->where('laporan', 'like', "%{$search}%")
                     ->orWhere('jenis_laporan', 'like', "%{$search}%")
                     ->orWhere('admin', 'like', "%{$search}%");
    })->get();

    return view('admin.laporan.index', compact('reports'));
}
}
