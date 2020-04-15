<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CustomAuth
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
      $category=Session::get('user')['category'];
      $usermailid=Session::get('user')['mailid'];
      if($category == 'Admin'){
          return $next($request);
      }else{
        return $next($request);
      }
    }
}
