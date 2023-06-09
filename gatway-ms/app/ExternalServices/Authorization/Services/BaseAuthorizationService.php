<?php

namespace App\ExternalServices\Authorization\Services;

use App\ExternalServices\Authorization\Contracts\AuthorizationServiceInterface;
use App\ExternalServices\Contracts\Services\BaseApiService;


abstract class BaseAuthorizationService extends BaseApiService implements AuthorizationServiceInterface
{
    
    private $base_url;
    public $secret;

    /**
     * BaseAuthorizationService constructor.
     */
    public function __construct()
    {
        $this->base_url = config('services.ms_authorization.url') . '/api';
        $this->secret = config('services.authors.secret');
    }

    /**
     * @return string
     */
    abstract function baseServiceUrl();

    /**
     * @return string
     */
    protected function getFullServiceUrl()
    {
        return $this->base_url . '/' . $this->baseServiceUrl();
    }


    
}
