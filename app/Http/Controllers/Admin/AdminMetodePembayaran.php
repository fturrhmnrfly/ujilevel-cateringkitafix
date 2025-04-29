<?php

namespace App\Http\Controllers\Admin;

use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminMetodePembayaran extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodePembayaran = MetodePembayaran::all();
        return view('admin.metodepembayaran.index', compact('metodePembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $metodeOptions = ['Transfer Bank', 'E-Wallet', 'Cash'];
        $statusOptions = ['Aktif', 'Tidak Aktif'];

        return view('admin.metodepembayaran.create', compact('metodeOptions', 'statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'metode_pembayaran' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|string|',
            'admin' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        MetodePembayaran::create($request->only(['metode_pembayaran', 'deskripsi', 'status', 'admin']));

        return redirect()->route('admin.metodepembayaran.index')
            ->with('success', 'Metode pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $metodePembayaran = MetodePembayaran::findOrFail($id);
        return view('admin.metodepembayaran.show', compact('metodePembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $metodePembayaran = MetodePembayaran::findOrFail($id);
        $metodeOptions = ['Transfer Bank', 'E-Wallet', 'Cash'];
        $statusOptions = ['Aktif', 'Tidak Aktif'];

        return view('admin.metodepembayaran.edit', compact('metodePembayaran', 'metodeOptions', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'metode_pembayaran' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
            'admin' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $metodePembayaran = MetodePembayaran::findOrFail($id);
        $metodePembayaran->update($request->only(['metode_pembayaran', 'deskripsi', 'status', 'admin']));

        return redirect()->route('admin.metodepembayaran.index')
            ->with('success', 'Metode pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $metodePembayaran = MetodePembayaran::findOrFail($id);
        $metodePembayaran->delete();

        return redirect()->route('admin.metodepembayaran.index')
            ->with('success', 'Metode pembayaran berhasil dihapus');
    }
}
