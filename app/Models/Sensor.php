<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LogsActivity;

class Sensor extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'nama_sensor',
        'threshold',
        'status',
    ];
}
