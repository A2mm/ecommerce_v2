<?php

namespace App\Http\Middleware\Owner;

use Closure;
use Auth;
use App\OwnerPrivilege;
class Customer
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
        if(Auth::user()->role('owner')){
          $privilege = OwnerPrivilege::where('user_id',Auth::user()->id)->pluck('privilege')->toArray();
          if(in_array('customer',$privilege) || in_array('general',$privilege)){
            return $next($request);
          }
          
        }
      }
          return redirect()->route('owner.login');

    }
}
