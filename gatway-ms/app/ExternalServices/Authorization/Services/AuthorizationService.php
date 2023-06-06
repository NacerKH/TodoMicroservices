<?php

namespace App\ExternalServices\Authorization\Services;


use App\Traits\ServiceCommunicationTrait;

class AuthorizationService extends BaseAuthorizationService
{
    use ServiceCommunicationTrait;

    function baseServiceUrl()
    {
        return 'authorization';
    }
}
