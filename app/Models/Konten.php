<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    protected $table = 'table_konten';

    protected $fillable = [
        'namaKoperasi',
        'logoKoperasi',
        'tagline',
        'bannerProgram',
        'kontak',
        'lokasi',
    ];
}
