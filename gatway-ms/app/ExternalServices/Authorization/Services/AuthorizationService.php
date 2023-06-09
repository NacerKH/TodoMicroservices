<?php

namespace App\ExternalServices\Authorization\Services;


use App\Traits\ServiceCommunicationTrait;
use Illuminate\Http\Request;

class AuthorizationService extends BaseAuthorizationService
{
    use ServiceCommunicationTrait;

    function baseServiceUrl()
    {
        return 'authorization';
    }

    public function login($request_data)
    {
        return $this->forwardRequest(Request::METHOD_POST, $this->getFullServiceUrl(). '/login', $request_data);
    }
}
