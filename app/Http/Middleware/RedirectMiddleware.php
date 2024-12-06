<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $params = $request->route('params');
        $authCheck = checkAuth(['params' => $params]);

        if (!$authCheck['status']) {
            if ($authCheck['redirect'] == '404') {
                abort(404);
            } elseif ($authCheck['redirect'] == 'login') {
                return redirect()->route('admin_page', ['params' => 'login'])
                    ->with('error', 'You must log in first');
            } elseif ($authCheck['redirect'] == 'already_logged_in') {
                return redirect()->route('admin_page')
                    ->with('error', 'Previously logged in');
            } elseif ($authCheck['redirect'] == 'no_access_authorization') {
                return redirect()->route('admin_page')
                    ->with('error', 'You do not have access authorization');
            }
        }

        return $next($request);
    }
}
