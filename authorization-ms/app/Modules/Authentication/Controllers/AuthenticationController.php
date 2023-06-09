<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Authentication\Repositories\AuthenticationRepository;
use App\Modules\Authentication\Requests\LoginRequest;
use App\Modules\Authentication\Requests\RegistrationRequest;
use Illuminate\Http\Request;


class AuthenticationController extends Controller
{


    /**
     * AuthenticationController constructor.
     * @param AuthenticationRepository $authenticationRepository
     * @param User $model
     */
    public function __construct(private AuthenticationRepository $authenticationRepository, private User $model) {}

    /**
     * Authenticates a user.
     *
     * @param LoginRequest $request The login request object containing email and password.
     * @return mixed The result of the authentication.
     */
      public function login(LoginRequest $request)
    {
        return $this->authenticationRepository->login($request->only(['email', 'password']));
    }

    /**
     * Registers a new user.
     *
     * @param RegistrationRequest $request The registration request object containing user data.
     * @return mixed The result of the registration.
     */
    public function register(RegistrationRequest $request)
    {

        $model_fillable = $this->model->getFillable();
        $model_fillable[] = 'password_confirmation';
        return $this->authenticationRepository->register($request->only($model_fillable));
    }

    /**
     * Logs out the user.
     *
     * @param Request $request The request object containing the refresh token.
     * @return mixed The result of refreshing the token.
     */
    public function logout(Request $request)
    {
        return $this->authenticationRepository->refreshToken($request->only(['refresh_token']));
    }

    /**
     * Checks the validity of the authentication token.
     *
     * @return mixed The result of checking the token.
     */
    
    public function checkToken()
    {
        return $this->authenticationRepository->checkToken();
    }




    /**
     * Checks if a password is valid for a given user.
     *
     * @param Request $request The request object containing the user ID and password.
     * @return mixed The result of checking the password.
     */

    public function checkPassword(Request $request)
    {
        return $this->authenticationRepository->checkPassword($request->only(['user_id', 'password']));
    }

   
}
