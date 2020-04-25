<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthAgencies
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
        if(Auth::guard('agency')->check() == false)
        {
            return redirect('agency/login');
        }
        return $next($request);
    }
}
