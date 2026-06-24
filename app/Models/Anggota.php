<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'table_anggota';

    protected $fillable = [
        'namaLengkap',
        'tempatLahir',
        'tanggalLahir',
        'jenisKelamin',
        'agama',
        'statusPerkawinan',
        'kewarganegaraan',
        'nomorKTP',
        'nomorKK',
        'alamatKTP',
        'alamatDomisili',
        'nomorHP',
        'email',
        'namaUsaha',
        'fotoUsaha',
        'fileKtp',
        'pekerjaan',
        'namaTempatKerja',
        'alamatTempatKerja',
        'jabatan',
        'penghasilan',
        'simpananWajib',
        'nomorRekening',
        'foto',
        'statusAnggota',
    ];

    protected $casts = [
        'tanggalLahir' => 'date:Y-m-d',
        'penghasilan'  => 'integer',
        'simpananWajib' => 'integer',
    ];
}
