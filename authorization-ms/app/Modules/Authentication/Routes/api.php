<?php

use App\Modules\Authentication\Controllers\AuthenticationController;
use App\Modules\Authentication\Controllers\PasswordsController;
use App\Modules\Authentication\Controllers\TwoFactorAuthController;
use App\Modules\Authentication\Controllers\VerificationsController;
use Illuminate\Support\Facades\Route;

Route::get('check-token', [AuthenticationController::class, 'checkToken'])
    ->middleware('auth:api');



Route::prefix('authorization')->group(function () {

    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('logout', [AuthenticationController::class, 'logout']);

    Route::post('check-password', [AuthenticationController::class, 'checkPassword']);

});
