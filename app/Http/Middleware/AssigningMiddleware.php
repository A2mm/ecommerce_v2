<?php

namespace App\Http\Middleware;

use Closure;
use App\Request;
use Auth; 

class AssigningMiddleware
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
        return $next($request);
    }

    public function terminate($request, $response)
    {
      $logged_user = Auth::user(); 
      $url = $request->fullUrl();
      include(app_path() . '/activityipget.php');
   
                $item    = json_encode($request->all());
                  if(strstr($url, 'store/user/roles')){
                    if (strlen($item) != 2) {
                             $r               = new Request();
                             $r->ip           = $ip;
                             $r->url          = $url;
                             $r->request      = json_encode($request->all());
                             $r->response     = $response;
                             $r->auth_id      = $logged_user->id;
                             $r->subject_type = 'assignUserRoles';
                             $r->save();
                      }
                  } 
    }
}
