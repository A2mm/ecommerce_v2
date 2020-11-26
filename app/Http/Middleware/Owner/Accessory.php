<?php

namespace App\Http\Middleware\Owner;

use Closure;
use Auth;
use App\OwnerPrivilege;
class Accessory
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
          //dd($privilege);
          //$privileges[] = $privilege;
          if(in_array('accessory',$privilege) || in_array('general',$privilege)){
            //dd($privilege);
            
            //dd($privilege);
            return $next($request);
          }
          
        }
      }
          return redirect()->route('owner.login');

    }
}
