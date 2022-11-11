<?php

namespace App\Http\Middleware;

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
        if($request->is('admin') || $request->is('admin/*')){
            return route('admin.login');
        }
        elseif($request->is('airport_admin') || $request->is('airport_admin/*')){
            return route('airport_admin.login');
        }
        elseif (! $request->expectsJson()) {
            return route('login');
        }
    }
}
