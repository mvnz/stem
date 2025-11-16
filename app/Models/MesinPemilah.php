<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LogsActivity;

class MesinPemilah extends Model
{
    use LogsActivity; 
    
    protected $fillable = [
        'nama_mesin',
        'konfigurasi',
        'status',
    ];
}
