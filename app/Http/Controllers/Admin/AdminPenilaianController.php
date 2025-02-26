<?php

namespace App\Http\Controllers\Admin;

use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminPenilaianController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::all();
        return view('admin.penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        return view('admin.penilaian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Penilaian::create($request->all());

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        return view('admin.penilaian.edit', compact('penilaian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $penilaian->update($request->all());

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }
}
