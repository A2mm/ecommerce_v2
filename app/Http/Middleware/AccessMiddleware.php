<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccessMiddleware
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
       // return $next($request);
       // $user = Auth::user();
        // return $user->roles;
       // $roles = Auth::user()->roles;
       /*  if (Auth::user()->hasPermissionTo('Administer')) //If user has this //permission
        {
            return $next($request);
        }
        else
        {
             abort('401');
         }*/

        if ($request->is('owner/manage/subcategories/create'))
         {
            if (Auth::user()->hasPermissionTo('view all sellers'))
            {
                // abort(404);
                return $next($request);
               //  return response()->json(['one' => 'two']);
            } 
            else 
            {
                 exit; // response()->json(['off' => 'on']);  
                 abort(404); 
            }
        }
/*
        if ($request->is('owner/manage/subcategories/create')) //If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('create subcategory'))
            {
                // abort('401');
                return 'notttttt';
            } 
            else 
            {
                return $next($request);
            }
        } */
       //  return $next($request);
    }
}




