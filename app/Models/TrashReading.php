<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\TrashWhatsappNotifier;
use App\Models\Traits\LogsActivity;

class TrashReading extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'device_id',
        'bin_height_cm',
        'distance_cm',
        'fill_pct',
        'payload',
        'measured_at'
    ];
    protected $casts = [
        'payload' => 'array',
        'measured_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::created(function (TrashReading $reading) {
            // setiap kali ADA record baru → auto panggil notifier
            app(TrashWhatsappNotifier::class)->handleNewReading($reading);
        });
    }
}

