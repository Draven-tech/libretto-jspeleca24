<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $token = $request->user()->currentAccessToken();
        
        if ($token && $token->expires_at && now()->gt($token->expires_at)) {
            return response()->json(['message' => 'Token expired'], 401);
        }
        
        return $next($request);
    }
}
