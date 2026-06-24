<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->paginate(10);
        return view('admin.pengumuman', compact('pengumumans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'keterangan' => 'required|string',
            'gambar'     => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'keterangan']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        Pengumuman::create($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'keterangan' => 'required|string',
            'gambar'     => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'keterangan']);

        if ($request->hasFile('gambar')) {
            if ($pengumuman->gambar) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->gambar) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function publish(Pengumuman $pengumuman)
    {
        $newStatus = $pengumuman->status === 'published' ? 'draft' : 'published';
        $pengumuman->update(['status' => $newStatus]);
        $message = $newStatus === 'published' ? 'Pengumuman berhasil dipublish.' : 'Pengumuman berhasil diarsipkan.';
        return redirect()->route('admin.pengumuman')->with('success', $message);
    }
}
