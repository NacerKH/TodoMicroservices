<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

      if ( app()->environment('testing')) {
        
            return $next($request);
        }
        // explode then check for the token if  token exists proceed or else abort
        $validSecrets = explode(',',config('services.secret') );
     
        if (in_array($request->header('SecretKey'), $validSecrets)) {

            return $next($request);
        }

          return response()->json(['message' => 'Externel Request Unauthorized Service !  '], Response::HTTP_UNAUTHORIZED);
    }
}
