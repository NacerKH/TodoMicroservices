<?php

namespace App\ExternalServices\Authorization\Controllers;

use App\ExternalServices\Authorization\Services\AuthorizationService;
use App\Http\Controllers\Controller;
use App\Traits\BaseApiResponse;


class AuthorizationController extends Controller
{
    use BaseApiResponse;
    /**
     * @var AuthorizationService
     */


    /**
     * AuthorizationController constructor.
     * @param AuthorizationService $authorizationService
     * 
     */
    public function __construct(private AuthorizationService $authorizationService)
    {
   
    }


}
