<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempatSampah extends Model
{
    protected $fillable = [
        'nama_tempat_sampah',
        'id_tower',
        'lantai',
        'id_sensor',
        'status',
    ];
}
