<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MesinPemilah extends Model
{
    protected $fillable = [
        'nama_mesin',
        'konfigurasi',
        'status',
    ];
}
