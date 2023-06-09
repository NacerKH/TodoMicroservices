<?php

namespace App\Modules\Authentication\Repositories;
use App\Models\User;
use App\Modules\Authentication\Contracts\AuthenticationRepositoryInterface;
use App\Modules\Concerns\BaseApiRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http as HttpClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

use Laravel\Passport\Client as PassportClient;

/**
 * This class handles authentication-related operations such as login, registration, token refresh, etc.
 */
class AuthenticationRepository  extends BaseApiRepository   implements AuthenticationRepositoryInterface
{
    // Constants
    const PASSPORT_AUTH_ROUTE = '/oauth/token';
    const APP_LOGIN_URL = 'app.login_url';
    const REQUIRED_STRING = 'required|string';

   


    /**
     * Authenticates a user with the provided credentials.
     *
     * @param array $request_data The login request data containing email and password.
     * @return mixed The authentication result.
     */
    public function login($request_data)
    {
        $client = PassportClient::firstOrFail();
        $user = User::where('email', $request_data['email'])->first();

        if (!isset($user['email'])) return $this->error(__('auth.login_failed'), 401);

        $response = HttpClient::post(config(self::APP_LOGIN_URL) . self::PASSPORT_AUTH_ROUTE, [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $user->getOriginal('email'),
            'password' => $request_data['password'],
            'provider' => 'users'
        ]);

        if (!$response->successful()) {
            Log::warning("User failed to login", ['id' => $user->id]);
            return $this->error(__('auth.login_failed'), 401);
        }

        $this->loginLog($user ,class_basename(__CLASS__), $functionName=__FUNCTION__);

        Log::info("User logged in successfully", ['id' => $user->id]);

        RateLimiter::resetAttempts(md5('logins' . \request()->ip()));

        return $this->success(__('auth.login_successful'), $response->json());

   
    }
    /**
     * Registers a new user with the provided data.
     *
     * @param array $request_data The registration request data containing user details.
     * @return mixed The registration result.
     */
    public function register($request_data)
    {

        $request_data['password'] = bcrypt($request_data['password']);
        $user = User::create($request_data);
        event(new Registered($user));
        return $this->success(__('auth.user_created'), $user);   
      
    }


    /**
     * Refreshes the authentication token using the provided refresh token.
     *
     * @param array $request_data The request data containing the refresh token.
     * @return mixed The result of refreshing the token.
     */
    public function refreshToken($request_data)
    {
        Validator::make($request_data,['refresh_token' => 'required|string'])->validate();

        $client = PassportClient::firstOrFail();

        $response = HttpClient::post(config(self::APP_LOGIN_URL) . self::PASSPORT_AUTH_ROUTE, [
            'grant_type' => 'refresh_token',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'refresh_token' => $request_data['refresh_token']
        ]);
        abort_if(!$response->successful(), $response->status(), $response->body());
        return $response->json();
    }
    /**
     * Checks the validity of the authentication token.
     *
     * @return mixed The result of checking the token.
     */
    public function checkToken()
    {
        return auth()->id() 
            ? $this->success(__('auth.valid_auth_token'), auth()->user()->last_login)
            : abort(401);
    }


    /**
     * Checks if the provided password matches the password of the specified user.
     *
     * @param array $data The request data containing the user ID and password.
     * @return mixed The result of checking the password.
     */
    public function checkPassword($data)
    {
        $user = User::findOrFail($data['user_id']);

        if (!Hash::check($data['password'], $user->password)) {
            return $this->error(__('auth.password_incorrect'), 403);
        }

        return $this->success(__('auth.password_matching'));
    }

   
}
