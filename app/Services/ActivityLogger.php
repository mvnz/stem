<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    public static function log(
        string $action,
        ?string $description = null,
        $model = null,
        ?array $changes = null
    ): ActivityLog {
        $user = Auth::user();

        return ActivityLog::create([
            'user_id'    => $user?->id,
            'action'     => $action,
            'model_type' => $model ? get_class($model) : null,
            'model_id'   => $model->id ?? null,
            'description'=> $description,
            'changes'    => $changes,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
        ]);
    }
}
