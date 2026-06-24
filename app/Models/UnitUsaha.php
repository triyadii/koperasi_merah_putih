<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitUsaha extends Model
{
    protected $table = 'table_unit_usaha';

    protected $fillable = [
        'namaUsaha',
        'foto',
        'keterangan',
    ];
}
