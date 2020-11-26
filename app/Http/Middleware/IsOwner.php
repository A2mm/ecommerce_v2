<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsOwner
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
        if(Auth::check() && Auth::user()->role('owner') && Auth::user()->suspend != 1)
        {
              return $next($request);
        }
        else
        {
             return redirect()->route('owner.login');
        }
    }
}
