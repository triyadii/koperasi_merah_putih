<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    public function index()
    {
        $konten = Konten::first();
        return view('admin.konten', compact('konten'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKoperasi'  => 'required|string|max:255',
            'logoKoperasi'  => 'required|image|max:2048',
            'tagline'       => 'required|string',
            'bannerProgram' => 'required|string',
            'kontak'        => 'nullable|string|max:20',
            'lokasi'        => 'nullable|string',
        ]);

        $logoPath = $request->file('logoKoperasi')->store('konten', 'public');

        Konten::create([
            'namaKoperasi'  => $request->namaKoperasi,
            'logoKoperasi'  => $logoPath,
            'tagline'       => $request->tagline,
            'bannerProgram' => $request->bannerProgram,
            'kontak'        => $request->kontak,
            'lokasi'        => $request->lokasi,
        ]);

        return redirect()->route('admin.konten')->with('success', 'Konten berhasil ditambahkan.');
    }

    public function update(Request $request, Konten $konten)
    {
        $request->validate([
            'namaKoperasi'  => 'required|string|max:255',
            'logoKoperasi'  => 'nullable|image|max:2048',
            'tagline'       => 'required|string',
            'bannerProgram' => 'required|string',
            'kontak'        => 'nullable|string|max:20',
            'lokasi'        => 'nullable|string',
        ]);

        $data = [
            'namaKoperasi'  => $request->namaKoperasi,
            'tagline'       => $request->tagline,
            'bannerProgram' => $request->bannerProgram,
            'kontak'        => $request->kontak,
            'lokasi'        => $request->lokasi,
        ];

        if ($request->hasFile('logoKoperasi')) {
            Storage::disk('public')->delete($konten->logoKoperasi);
            $data['logoKoperasi'] = $request->file('logoKoperasi')->store('konten', 'public');
        }

        $konten->update($data);

        return redirect()->route('admin.konten')->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(Konten $konten)
    {
        Storage::disk('public')->delete($konten->logoKoperasi);
        $konten->delete();

        return redirect()->route('admin.konten')->with('success', 'Konten berhasil dihapus.');
    }
}
