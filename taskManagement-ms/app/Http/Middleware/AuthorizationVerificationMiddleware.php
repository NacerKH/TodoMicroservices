<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->header('X-User-Id');

        if (!$userId) {
            // Handle the case where X-User-Id header is missing
            return response()->json(['error' => 'Unauthorized ! TaskManagemt-ms'], Response::HTTP_UNAUTHORIZED);
        }
        
        $request->merge([
            'user_id' =>$userId,
        ]);
        return $next($request);
    }
}
