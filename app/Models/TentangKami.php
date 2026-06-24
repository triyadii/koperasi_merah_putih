<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    protected $table = 'table_tentang_kami';

    protected $fillable = [
        'sejarah',
        'latarBelakang',
        'Visi',
        'Misi',
        'nilai',
        'tujuanUtama',
        'dasarHukum',
    ];
}
