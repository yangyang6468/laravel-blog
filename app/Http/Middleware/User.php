<?php

namespace App\Http\Middleware;

use Closure;

class User
{
    /**
     * 判断用户是否登录
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->user()){
            return redirect('/');
        }
        return $next($request);

    }
}
