<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index()
    {
        $tentangKami = TentangKami::first();
        return view('admin.tentangKami', compact('tentangKami'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sejarah'     => 'required|string',
            'latarBelakang' => 'required|string',
            'Visi'        => 'required|string',
            'Misi'        => 'required|string',
            'nilai'       => 'required|string',
            'tujuanUtama' => 'required|string',
            'dasarHukum'  => 'required|string',
        ]);

        TentangKami::create($request->only([
            'sejarah', 'latarBelakang', 'Visi', 'Misi', 'nilai', 'tujuanUtama', 'dasarHukum',
        ]));

        return redirect()->route('admin.tentangKami')->with('success', 'Data Tentang Kami berhasil ditambahkan.');
    }

    public function update(Request $request, TentangKami $tentangKami)
    {
        $request->validate([
            'sejarah'     => 'required|string',
            'latarBelakang' => 'required|string',
            'Visi'        => 'required|string',
            'Misi'        => 'required|string',
            'nilai'       => 'required|string',
            'tujuanUtama' => 'required|string',
            'dasarHukum'  => 'required|string',
        ]);

        $tentangKami->update($request->only([
            'sejarah', 'latarBelakang', 'Visi', 'Misi', 'nilai', 'tujuanUtama', 'dasarHukum',
        ]));

        return redirect()->route('admin.tentangKami')->with('success', 'Data Tentang Kami berhasil diperbarui.');
    }

    public function destroy(TentangKami $tentangKami)
    {
        $tentangKami->delete();
        return redirect()->route('admin.tentangKami')->with('success', 'Data Tentang Kami berhasil dihapus.');
    }
}
