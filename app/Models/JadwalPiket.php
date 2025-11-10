<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPiket extends Model
{
    protected $fillable = [
        'pegawai_id', 
        'tower_id', 
        'tanggal', 
        'shift', 
        'jam_mulai', 
        'jam_selesai',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function tower()
    {
        return $this->belongsTo(Tower::class, 'tower_id');
    }

    public static function jamShift(string $shift)
    {
        return match ($shift) {
            'Pagi' => ['00:01:00', '08:00:00'],
            'Siang' => ['08:01:00', '16:00:00'],
            'Malam' => ['16:01:00', '00:00:00'],
            'Libur' => [null, null],
            default => [null, null],
        };
    }
}


