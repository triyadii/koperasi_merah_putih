<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuanganKas extends Model
{
    protected $table = 'table_keuangan_kas';

    protected $fillable = [
        'nomorAnggota',
        'namaAnggota',
        'simpananPokok',
        'simpananWajib',
        'tanggalBayar',
        'keterangan',
    ];

    protected $casts = [
        'tanggalBayar' => 'date:Y-m-d',
        'simpananPokok' => 'integer',
        'simpananWajib' => 'integer',
    ];
}
