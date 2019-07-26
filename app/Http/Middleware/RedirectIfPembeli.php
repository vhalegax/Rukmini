<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfPembeli
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard="pembeli")
    {
        if(auth()->guard($guard)->check()) {
            return redirect(route('home'));
        }
        return $next($request);
    }
}
