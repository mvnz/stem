<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'nama_sensor',
        'tipe_sensor',
        'lokasi_sensor',
        'status',
    ];
}
