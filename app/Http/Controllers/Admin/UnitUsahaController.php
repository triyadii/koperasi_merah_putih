<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnitUsahaController extends Controller
{
    public function index()
    {
        $unitUsahas = UnitUsaha::latest()->paginate(10);
        return view('admin.unitUsaha', compact('unitUsahas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaUsaha'  => 'required|string|max:200',
            'foto'       => 'nullable|image|max:2048',
            'keterangan' => 'required|string',
        ]);

        $data = $request->only(['namaUsaha', 'keterangan']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('unit_usaha', 'public');
        }

        UnitUsaha::create($data);

        return redirect()->route('admin.unitUsaha')->with('success', 'Unit usaha berhasil ditambahkan.');
    }

    public function update(Request $request, UnitUsaha $unitUsaha)
    {
        $request->validate([
            'namaUsaha'  => 'required|string|max:200',
            'foto'       => 'nullable|image|max:2048',
            'keterangan' => 'required|string',
        ]);

        $data = $request->only(['namaUsaha', 'keterangan']);

        if ($request->hasFile('foto')) {
            if ($unitUsaha->foto) {
                Storage::disk('public')->delete($unitUsaha->foto);
            }
            $data['foto'] = $request->file('foto')->store('unit_usaha', 'public');
        }

        $unitUsaha->update($data);

        return redirect()->route('admin.unitUsaha')->with('success', 'Unit usaha berhasil diperbarui.');
    }

    public function destroy(UnitUsaha $unitUsaha)
    {
        if ($unitUsaha->foto) {
            Storage::disk('public')->delete($unitUsaha->foto);
        }
        $unitUsaha->delete();
        return redirect()->route('admin.unitUsaha')->with('success', 'Unit usaha berhasil dihapus.');
    }
}
