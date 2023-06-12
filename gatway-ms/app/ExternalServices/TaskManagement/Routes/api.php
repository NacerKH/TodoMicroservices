<?php

use App\ExternalServices\TaskManagement\Controllers\TaskManagementController;
use Illuminate\Support\Facades\Route;

Route::prefix('TaskManagement')->group(function () {
    Route::get('/test', function () {
        return 'TaskManagement';
    });
   Route::apiResource('list-task', TaskManagementController::class)->middleware('checkAuth');
});


