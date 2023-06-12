<?php

use App\Modules\TodoList\Controllers\ListTaskController;
use App\Modules\TodoList\Controllers\TaskController;
use Illuminate\Support\Facades\Route;




Route::prefix('TaskManagement')->group(function () {

Route::apiResource('/list-task', ListTaskController::class)->parameters(['' => 'listTask']);;
Route::apiResource('/task', TaskController::class)->parameters(['' => 'task']);;
});
