<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'nama_pegawai',
        'alamat',
        'no_telp',
        'unit_kerja',
        'status',
    ];

    public function jadwalPikets()
    {
        return $this->hasMany(JadwalPiket::class, 'pegawai_id');
    }
}
