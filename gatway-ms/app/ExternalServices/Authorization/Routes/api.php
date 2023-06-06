<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authorization')->group(function () {
    Route::get('/test', function () {
        return 'Authorization';
    });

});


