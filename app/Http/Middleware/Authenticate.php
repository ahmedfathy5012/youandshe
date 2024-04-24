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
         if($request->is("api/*")){
            exceptionResponse('يجب عليك تسجيل الدخول اولا');
         }
        // if (! $request->expectsJson()) {
        //     exceptionResponse('يجب عليك تسجيل الدخول اولا');
        //     // return route('login_admin_form');
        // }
    }
}
