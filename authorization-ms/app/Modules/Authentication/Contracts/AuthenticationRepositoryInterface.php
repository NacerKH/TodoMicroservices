<?php

namespace App\Modules\Authentication\Contracts;

interface AuthenticationRepositoryInterface
{



    public function login($request_data);
    public function register($request_data);
    public function refreshToken($request_data);
    public function checkToken();
 
}
