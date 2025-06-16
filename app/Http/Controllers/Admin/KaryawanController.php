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
        // ✅ HILANGKAN VALIDASI EMAIL UNIQUE KARENA KOLOM TIDAK ADA ✅
        $validated = $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'email' => 'required|email|max:255', // ✅ HANYA VALIDASI FORMAT, BUKAN UNIQUE ✅
            'kontak' => 'required|string|max:15',
            'tipe_pengguna' => 'required|in:admin,karyawan,user',
        ]);

        // ✅ VALIDASI MANUAL EMAIL UNIQUE MENGGUNAKAN VIRTUAL ATTRIBUTE ✅
        $existingKaryawan = Karyawan::all()->first(function ($karyawan) use ($validated) {
            return $karyawan->email === $validated['email'];
        });

        if ($existingKaryawan) {
            return redirect()->back()
                ->withErrors(['email' => 'Email sudah digunakan'])
                ->withInput();
        }

        // ✅ MAPPING FIELD FORM KE DATABASE SCHEMA ✅
        $data = [
            'nama_karyawan' => $validated['nama_karyawan'],
            'username_karyawan' => strtolower(str_replace(' ', '', $validated['nama_karyawan'])) . rand(100, 999),
            'posisi' => $this->mapTipePenggunaToPositions($validated['tipe_pengguna']),
            'kontak' => $validated['kontak'],
            // ✅ SIMPAN EMAIL DI FIELD DESKRIPSI UNTUK WORKAROUND ✅
            'keahlian' => $this->mapTipePenggunaToKeahlian($validated['tipe_pengguna']) . ' | Email: ' . $validated['email'],
            'tanggal_bergabung' => now()->toDateString(),
            'status' => 'Aktif',
        ];

        Karyawan::create($data);

        return redirect()->route('admin.karyawan.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        
        // ✅ HILANGKAN VALIDASI EMAIL UNIQUE KARENA KOLOM TIDAK ADA ✅
        $validated = $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'email' => 'required|email|max:255', // ✅ HANYA VALIDASI FORMAT ✅
            'kontak' => 'required|string|max:15',
            'tipe_pengguna' => 'required|in:admin,karyawan,user',
        ]);

        // ✅ VALIDASI MANUAL EMAIL UNIQUE KECUALI RECORD SAAT INI ✅
        $existingKaryawan = Karyawan::where('id', '!=', $id)->get()->first(function ($k) use ($validated) {
            return $k->email === $validated['email'];
        });

        if ($existingKaryawan) {
            return redirect()->back()
                ->withErrors(['email' => 'Email sudah digunakan'])
                ->withInput();
        }

        // ✅ MAPPING FIELD FORM KE DATABASE SCHEMA ✅
        $data = [
            'nama_karyawan' => $validated['nama_karyawan'],
            'posisi' => $this->mapTipePenggunaToPositions($validated['tipe_pengguna']),
            'kontak' => $validated['kontak'],
            // ✅ UPDATE EMAIL DI FIELD KEAHLIAN ✅
            'keahlian' => $this->mapTipePenggunaToKeahlian($validated['tipe_pengguna']) . ' | Email: ' . $validated['email'],
        ];

        $karyawan->update($data);

        return redirect()->route('admin.karyawan.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.karyawan.index')->with('success', 'Pengguna berhasil dihapus');
    }

    // ✅ HELPER METHODS UNTUK MAPPING ✅
    private function mapTipePenggunaToPositions($tipe)
    {
        $mapping = [
            'admin' => 'Administrator',
            'karyawan' => 'Staff Operasional',
            'user' => 'Customer Service'
        ];

        return $mapping[$tipe] ?? 'Staff';
    }

    private function mapTipePenggunaToKeahlian($tipe)
    {
        $mapping = [
            'admin' => 'Manajemen Sistem, Administrasi',
            'karyawan' => 'Operasional Catering, Customer Service',
            'user' => 'Customer Support, Data Entry'
        ];

        return $mapping[$tipe] ?? 'General';
    }
}
