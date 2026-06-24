<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::latest()->paginate(10);
        return view('admin.anggota', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaLengkap'      => 'required|string|max:255',
            'tempatLahir'      => 'required|string|max:100',
            'tanggalLahir'     => 'required|date',
            'jenisKelamin'     => 'required|in:Laki-laki,Perempuan',
            'agama'            => 'required|string|max:50',
            'statusPerkawinan' => 'required|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',
            'kewarganegaraan'  => 'required|string|max:50',
            'nomorKTP'         => 'required|string|max:20|unique:table_anggota,nomorKTP',
            'nomorKK'          => 'required|string|max:20',
            'alamatKTP'        => 'required|string',
            'alamatDomisili'   => 'nullable|string',
            'nomorHP'          => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'namaUsaha'        => 'nullable|string|max:255',
            'fotoUsaha'        => 'nullable|image|max:2048',
            'fileKtp'          => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'pekerjaan'        => 'nullable|string|max:100',
            'namaTempatKerja'  => 'nullable|string|max:255',
            'alamatTempatKerja' => 'nullable|string',
            'jabatan'          => 'nullable|string|max:100',
            'penghasilan'      => 'nullable|integer|min:0',
            'simpananWajib'    => 'required|integer|min:0',
            'nomorRekening'    => 'nullable|string|max:50',
            'foto'             => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['foto', 'fotoUsaha', 'fileKtp', '_token']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        if ($request->hasFile('fotoUsaha')) {
            $data['fotoUsaha'] = $request->file('fotoUsaha')->store('usaha', 'public');
        }

        if ($request->hasFile('fileKtp')) {
            $data['fileKtp'] = $request->file('fileKtp')->store('ktp', 'public');
        }

        Anggota::create($data);

        return redirect()->route('admin.anggota')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'namaLengkap'      => 'required|string|max:255',
            'tempatLahir'      => 'required|string|max:100',
            'tanggalLahir'     => 'required|date',
            'jenisKelamin'     => 'required|in:Laki-laki,Perempuan',
            'agama'            => 'required|string|max:50',
            'statusPerkawinan' => 'required|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',
            'kewarganegaraan'  => 'required|string|max:50',
            'nomorKTP'         => 'required|string|max:20|unique:table_anggota,nomorKTP,' . $anggota->id,
            'nomorKK'          => 'required|string|max:20',
            'alamatKTP'        => 'required|string',
            'alamatDomisili'   => 'nullable|string',
            'nomorHP'          => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'namaUsaha'        => 'nullable|string|max:255',
            'fotoUsaha'        => 'nullable|image|max:2048',
            'fileKtp'          => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'pekerjaan'        => 'nullable|string|max:100',
            'namaTempatKerja'  => 'nullable|string|max:255',
            'alamatTempatKerja' => 'nullable|string',
            'jabatan'          => 'nullable|string|max:100',
            'penghasilan'      => 'nullable|integer|min:0',
            'simpananWajib'    => 'required|integer|min:0',
            'nomorRekening'    => 'nullable|string|max:50',
            'foto'             => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['foto', 'fotoUsaha', 'fileKtp', '_token', '_method']);

        if ($request->hasFile('foto')) {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        if ($request->hasFile('fotoUsaha')) {
            if ($anggota->fotoUsaha) {
                Storage::disk('public')->delete($anggota->fotoUsaha);
            }
            $data['fotoUsaha'] = $request->file('fotoUsaha')->store('usaha', 'public');
        }

        if ($request->hasFile('fileKtp')) {
            if ($anggota->fileKtp) {
                Storage::disk('public')->delete($anggota->fileKtp);
            }
            $data['fileKtp'] = $request->file('fileKtp')->store('ktp', 'public');
        }

        $anggota->update($data);

        return redirect()->route('admin.anggota')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }
        if ($anggota->fotoUsaha) {
            Storage::disk('public')->delete($anggota->fotoUsaha);
        }
        if ($anggota->fileKtp) {
            Storage::disk('public')->delete($anggota->fileKtp);
        }
        $anggota->delete();
        return redirect()->route('admin.anggota')->with('success', 'Anggota berhasil dihapus.');
    }

    public function activate(Anggota $anggota)
    {
        $newStatus = $anggota->statusAnggota === 'aktif' ? 'nonaktif' : 'aktif';
        $anggota->update(['statusAnggota' => $newStatus]);

        $message = $newStatus === 'aktif'
            ? 'Anggota berhasil diaktifkan.'
            : 'Anggota berhasil dinonaktifkan.';

        return redirect()->route('admin.anggota')->with('success', $message);
    }
}
