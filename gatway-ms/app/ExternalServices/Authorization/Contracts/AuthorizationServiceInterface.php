<?php

namespace App\ExternalServices\Authorization\Contracts;

use App\ExternalServices\Contracts\BaseApiServiceInterface;

interface AuthorizationServiceInterface   extends BaseApiServiceInterface
{
    public function login($request_data);
}
