<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifWhatsapp extends Model
{
    protected $fillable = [
        'no_hp',
        'pesan',
        'status',
        'response',
        'sent_at',
    ];

    protected $casts = [
        'response' => 'array',
        'sent_at'  => 'datetime',
    ];
}
