<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;
class Lang
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
        $lang = session('language','en');
        App::setLocale($lang);
        return $next($request);
    }
}
