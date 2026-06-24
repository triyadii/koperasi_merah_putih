<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'table_berita';

    protected $fillable = [
        'judul',
        'tag',
        'keterangan',
        'status',
        'gambar',
    ];
}
