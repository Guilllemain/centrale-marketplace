<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateViaSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session('authenticated')) {
            if ($request->wantsJson()) {
                return response([], 401);
            }
            return redirect('/login');
        }
        return $next($request);
    }
}
