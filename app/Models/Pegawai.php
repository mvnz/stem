<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LogsActivity;

class Pegawai extends Model
{
    use LogsActivity;

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
