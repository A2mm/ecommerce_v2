<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;
use Session;
use Artisan;

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
        $lang = Session::get('language');
        App::setLocale($lang);
        Artisan::call('optimize:clear');
        return $next($request);
    }
}
