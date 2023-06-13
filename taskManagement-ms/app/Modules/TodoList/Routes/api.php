<?php

use App\Modules\TodoList\Controllers\ListTaskController;
use App\Modules\TodoList\Controllers\TaskController;
use Illuminate\Support\Facades\Route;




Route::prefix('TaskManagement')->group(function () {

Route::apiResource('/list-task', ListTaskController::class)->parameters(['' => 'listTask']);

Route::prefix('task')->group(function () {

Route::apiResource('/', TaskController::class)->parameters(['' => 'task']);

Route::post('/assign/{task:id}',[TaskController::class, 'assignTask']);

Route::get('/User/Tasks', [TaskController::class, 'findUserTasks']);

});

});
