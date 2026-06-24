<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita', compact('beritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'tag'        => 'nullable|string|max:100',
            'keterangan' => 'required|string',
            'gambar'     => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'tag', 'keterangan']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'tag'        => 'nullable|string|max:100',
            'keterangan' => 'required|string',
            'gambar'     => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'tag', 'keterangan']);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil dihapus.');
    }

    public function publish(Berita $berita)
    {
        $newStatus = $berita->status === 'published' ? 'draft' : 'published';
        $berita->update(['status' => $newStatus]);
        $message = $newStatus === 'published' ? 'Berita berhasil dipublish.' : 'Berita berhasil diarsipkan.';
        return redirect()->route('admin.berita')->with('success', $message);
    }
}
