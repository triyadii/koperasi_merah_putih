<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('landing.pendaftaran');
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

        // Set default status to nonaktif
        $data['statusAnggota'] = 'nonaktif';

        Anggota::create($data);

        return redirect()->route('pendaftaran')->with('success', 'Pendaftaran berhasil dikirim! Kami akan menghubungi Anda setelah data diverifikasi.');
    }
}
