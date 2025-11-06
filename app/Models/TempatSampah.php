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

    public function tower()
    {
        return $this->belongsTo(Tower::class, 'id_tower');
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class, 'id_sensor');
    }
}
