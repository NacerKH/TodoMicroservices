<?php

use App\ExternalServices\TaskManagement\Controllers\ListTaskManagementController;
use App\ExternalServices\TaskManagement\Controllers\TaskManagementController;
use Illuminate\Support\Facades\Route;

Route::prefix('TaskManagement')->middleware(['checkAuth'])->group(function () {
   Route::get('/test', function () {
        return 'TaskManagement';
    });
   Route::apiResource('list-task', ListTaskManagementController::class);

   Route::apiResource('task', TaskManagementController::class);

   Route::post('task/assign/{id}', [TaskManagementController::class, 'assign']);

   Route::get('task/User/Tasks', [TaskManagementController::class, 'userTasks']);
});


