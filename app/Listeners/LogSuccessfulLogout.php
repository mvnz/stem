<?php 

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Services\ActivityLogger;

class LogSuccessfulLogout
{
    public function handle(Logout $event): void
    {
        ActivityLogger::log(
            'logout',
            'User logout',
            null,
            ['user_id' => $event->user->id]
        );
    }
}
