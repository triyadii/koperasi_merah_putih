<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'table_pengumuman';

    protected $fillable = [
        'judul',
        'keterangan',
        'status',
        'gambar',
    ];
}
