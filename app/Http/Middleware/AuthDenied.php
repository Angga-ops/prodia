<?php

namespace App\Http\Middleware;

use Closure;

class AuthDenied
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
        if (session()->has('token')) {
            return redirect('/');
        }
        return $next($request);
    }
}
