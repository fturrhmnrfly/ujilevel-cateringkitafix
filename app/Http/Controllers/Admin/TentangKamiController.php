<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index()
    {
        $tentangkami = TentangKami::all();
        return view('admin.tentangkami.index', compact('tentangkami'));
    }

    public function create()
    {
        return view('admin.tentangkami.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string'
        ]);

        $foto = $request->file('foto')->store('tentangkami', 'public');

        TentangKami::create([
            'foto' => $foto,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.tentangkami.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tentangkami = TentangKami::findOrFail($id);
        return view('admin.tentangkami.edit', compact('tentangkami'));
    }

    public function update(Request $request, $id)
    {
        $tentangkami = TentangKami::findOrFail($id);
        
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string'
        ]);

        $data = [
            'deskripsi' => $request->deskripsi
        ];

        if ($request->hasFile('foto')) {
            // Delete old image
            if ($tentangkami->foto) {
                \Storage::disk('public')->delete($tentangkami->foto);
            }
            // Store new image
            $data['foto'] = $request->file('foto')->store('tentangkami', 'public');
        }

        $tentangkami->update($data);

        return redirect()->route('admin.tentangkami.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tentangkami = TentangKami::findOrFail($id);
        if ($tentangkami->foto) {
            \Storage::disk('public')->delete($tentangkami->foto);
        }
        $tentangkami->delete();
        return redirect()->route('admin.tentangkami.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
