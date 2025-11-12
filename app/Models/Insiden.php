<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insiden extends Model
{
    protected$fillable = [
        'tanggal_insiden',
        'tanggal_close',
        'tower_id',
        'jenis_insiden',
        'deskripsi_insiden',
        'status_insiden',
        'user_id',
        'catatan_perbaikan',
    ];

    protected $casts = [
        'tanggal_insiden' => 'date',
        'jam_insiden' => 'time',
    ];

    public function tower()
    {
        return $this->belongsTo(Tower::class, 'tower_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
    
}
