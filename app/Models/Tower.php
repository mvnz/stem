<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LogsActivity;

class Tower extends Model
{
    use LogsActivity;
    
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
