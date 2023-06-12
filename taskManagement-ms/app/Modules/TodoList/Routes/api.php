<?php

use App\Modules\TodoList\Controllers\ListTaskController;
use Illuminate\Support\Facades\Route;




Route::prefix('TaskManagement')->group(function () {

Route::apiResource('/', ListTaskController::class);
});
