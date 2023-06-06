<?php


use Illuminate\Support\Facades\Route;

Route::prefix('TaskManagement')->group(function () {
    Route::get('/test', function () {
        return 'TaskManagement';
    });

});


