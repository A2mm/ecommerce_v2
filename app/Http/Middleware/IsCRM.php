<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsCRM
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
      if (Auth::check()) {
          if(Auth::user()->role('crm')){
            return $next($request);
          }
        }
      return redirect()->route('crm.login');
    }
}
