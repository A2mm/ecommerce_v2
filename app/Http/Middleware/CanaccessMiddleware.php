<?php

namespace App\Http\Middleware;

use Closure;
use Auth; 

class CanaccessMiddleware
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
        if (Auth::user()->hasPermissionTo('Administer')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('/owner/manage/subcategories')) //If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('view all subcategories'))
            {
                abort('401');
            } 
            else 
            {
                return $next($request);
            }
        }

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
        }
       //  return $next($request);
    }
}
