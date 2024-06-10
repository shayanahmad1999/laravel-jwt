<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckApiAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookieHeader = $request->header('cookie');

        if ($cookieHeader) {
            
            $cookies = explode(';', $cookieHeader);

            $token = null;
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                if ($name === 'token') {
                    $token = trim($parts[1]);
                    break; 
                }
            }

            if ($token) {
                return $next($request);
            }
        }

        return redirect()->route('view.login');
    }
}
