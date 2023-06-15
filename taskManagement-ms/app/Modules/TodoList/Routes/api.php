<?php

use App\Modules\TodoList\Controllers\ListTaskController;
use App\Modules\TodoList\Controllers\TaskController;
use Illuminate\Support\Facades\Route;




Route::prefix('TaskManagement')->group(function () {

Route::apiResource('/list-task', ListTaskController::class)->parameters(['id' => 'listTask']);
Route::apiResource('task', TaskController::class)->parameters(['id' => 'task']);

Route::prefix('/task')->group(function () {

Route::post('/assign/{task:id}',[TaskController::class, 'assignTask']);

Route::get('/User/Tasks', [TaskController::class, 'findUserTasks']);

Route::post('/User/change-status/{task:id}', [TaskController::class, 'changeStatus']);

Route::post('/User/change-priority/{task:id}', [TaskController::class, 'changePriority']);


});

});
