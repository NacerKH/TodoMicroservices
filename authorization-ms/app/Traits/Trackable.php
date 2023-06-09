<?php

namespace App\Traits;

use App\Modules\ActivityLog\Models\ActivityLog;

trait Trackable
{
    private $model;

    public function model()
    {
        return class_basename($this);
    }

    public static function bootTrackable()
    {
        self::created(function ($model) {
            static::log('created', $model);
        });

        self::updated(function ($model) {
            static::log('updated', $model);
        });

        self::deleted(function ($model) {
            static::log('deleted', $model);
        });
    }

    public static function log($action, $model)
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'class_name' => class_basename($model),
            'action' => $action,
            'title' => $action . ' ' . class_basename($model),
            // 'data' => json_encode($model),
        ]);
    }
}