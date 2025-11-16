<?php 

namespace App\Models\Traits;

use App\Services\ActivityLogger;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            ActivityLogger::log(
                'create',
                'Tambah ' . class_basename($model),
                $model,
                ['new' => $model->getAttributes()]
            );
        });

        static::updated(function ($model) {
            ActivityLogger::log(
                'update',
                'Edit ' . class_basename($model),
                $model,
                [
                    'old' => $model->getOriginal(),
                    'new' => $model->getChanges(),
                ]
            );
        });

        static::deleted(function ($model) {
            ActivityLogger::log(
                'delete',
                'Hapus ' . class_basename($model),
                $model,
                ['old' => $model->getOriginal()]
            );
        });
    }
}
