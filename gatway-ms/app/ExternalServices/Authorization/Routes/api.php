<?php

use App\ExternalServices\Authorization\Controllers\AuthorizationController;
use Illuminate\Support\Facades\Route;

Route::prefix('authorization')->group(function () {
    Route::get('/test', function () {
        return 'Authorization';
    });
    
    Route::post('login', [AuthorizationController::class, 'UserLogin']);
});


