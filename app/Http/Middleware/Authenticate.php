<?php

namespace App\Http\Middleware;
use Session;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
          $userCat=Session::get('user')['category'];
          if(!isset($userCat)){
            return view('pages.login');
          }
          return $next($request);

    }

}
