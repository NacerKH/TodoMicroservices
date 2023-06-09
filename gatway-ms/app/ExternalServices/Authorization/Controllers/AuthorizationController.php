<?php

namespace App\ExternalServices\Authorization\Controllers;

use App\ExternalServices\Authorization\Services\AuthorizationService;
use App\Http\Controllers\Controller;
use App\Traits\BaseApiResponse;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    use BaseApiResponse;



    /**
     * AuthorizationController constructor.
     * @param AuthorizationService $authorizationService
     * 
     */
    public function __construct(private AuthorizationService $authorizationService)
    {
   
    }
   public function UserLogin()
   {
       $request_data =  request()->all();

      return $this->authorizationService->login($request_data);
 
   }

}
