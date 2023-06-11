<?php

namespace App\Http\Middleware;

use App\Traits\BaseApiResponse;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationVerificationMiddleware
{

    use BaseApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
     

        if ($request->hasHeader('Authorization')) {
            $response = Http::withHeaders([
                'Authorization' => $request->header('Authorization'),
                'Accept' => 'application/json',
                'SecretKey'=> config('services.authors.secret'),
              
            ])->get(config('services.ms_authorization.url') . '/api/check-token');

            if ($response->status() === 401) {
                throw new AuthenticationException('authorisation_ms_error');
            }

            if (!$response->successful()) {
                return $this->error(['ExternalServerError' => 'AuthMS'] + $response->json(), 500);
            }
        

            $request->headers->set('X-User-Id', $response->json('data.id'));
          
          
   
            return $next($request);
        }

        return $this->error('unauthenticated', 401);
    
    }
}
