<?php

namespace App\Modules\Authentication\Contracts;

use Illuminate\Http\Request;

interface PasswordsRepositoryInterface
{
    public function forgotPassword($request_data);
    public function resetPassword(Request $request);
    public function changePassword(Request $request);
}
