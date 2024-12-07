<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_login = getCachedKeyValue(['key' => 'show_user_login', 'first' => true, 'refreshCache' => true]) ?? null;
        if (isset($user_login) && $user_login->value) {
            return $next($request);
        }
        abort(404);
    }
}
