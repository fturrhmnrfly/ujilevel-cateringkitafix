<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('admin.karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('admin.karyawan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'username_karyawan' => 'required|string|max:255|unique:karyawan',
            'posisi' => 'required|string|max:255',
            'kontak' => 'required|string|max:15',
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|in:Aktif,Cuti,Nonaktif',
            'keahlian' => 'required|string|max:255',
        ]);

        Karyawan::create($validated);
        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        
        $validated = $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'username_karyawan' => 'required|string|max:255|unique:karyawan,username_karyawan,' . $id,
            'posisi' => 'required|string|max:255',
            'kontak' => 'required|string|max:15',
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|in:Aktif,Cuti,Nonaktif',
            'keahlian' => 'required|string|max:255',
        ]);

        $karyawan->update($validated);
        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
