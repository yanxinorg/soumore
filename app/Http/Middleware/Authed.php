<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	//验证用户是否登录
  public function handle($request, Closure $next)
    {
    	if (Auth::check()) {
    		return $next($request);
    	}
    	return redirect('/login');
    }
}
