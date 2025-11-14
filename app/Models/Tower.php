<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    protected $fillable = [
        'nama_tower',
        'jumlah_lantai',
        'status',
    ];

   public function jadwalPiket()
    {
        return $this->hasMany(JadwalPiket::class, 'tower_id');
    }
}
