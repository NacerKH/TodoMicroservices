<?php

use App\Modules\ActivityLog\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::prefix('/activity-logs')
    ->middleware(['auth:api'])
    ->group(function () {
        Route::get('/', [ActivityLogController::class, 'index']);
    });
