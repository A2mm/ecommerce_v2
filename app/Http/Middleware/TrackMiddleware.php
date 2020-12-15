<?php

namespace App\Http\Middleware;

use Closure;
use App\Request;

class TrackMiddleware
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
      $url = $request->fullUrl();

      // include(app_path() . '/activityipget.php');
     // $activity->ip = $ip;
           // return $ip; 
     // $ip = $_SERVER['REMOTE_ADDR'];
   
      $item    = json_encode($request->all());
      if(strstr($url, 'search/with/bill')){
        if (strlen($item) != 2) {
                 $r           = new Request();
                 $r->ip       = $ip;
                 $r->url      = $url;
                 $r->request  = json_encode($request->all());
                 $r->response = $response;
                 $r->save();
          }
      } 
      else
      {
                 $r           = new Request();
                 $r->ip       = $ip;
                 $r->url      = $url;
                 $r->request  = json_encode($request->all());
                 $r->response = $response;

                 if(!strstr($response, 'selllogin'))
                 {
                        $part = strstr($response, '{'); 
                        $part = json_decode($part); 
                        
                        foreach ($part as $key => $value)
                        {
                              if($key == 'dest'){
                                $subject_type = $value;
                              }

                             if($key == 'auth_id'){
                                $auth_id = $value;
                              }

                              if($key == 'code'){
                              if ($value == 200) {
                                 $result = 1;
                              }
                              else{
                                $result = 0;
                              }
                            }
                        }
                 }
                 else
                 {
                  $subject_type = 'selllogin';
                  $auth_id = null; 
                  $part = strstr($response, '{'); 
                  $part = json_decode($part); 
                        
                        foreach ($part as $key => $value)
                        {
                          if($key == 'code'){
                              if ($value == 200) {
                                 $result = 1;
                              }
                              else{
                                $result = 0;
                              }
                          }
                        }
                 }
                        
                           

                 $r->subject_type = $subject_type;
                 $r->result       = $result;
                 $r->auth_id      = $auth_id;

                 $r->save();
      }
    }
}
