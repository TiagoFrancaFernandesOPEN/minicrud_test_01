<?php

namespace App\Http\Middleware;

use Closure;
use Log;
class AuthuserMiddleware
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
        if($request->session()->exists('login')){
            return $next($request);
        }else{
            $msg = "You are not logged";
            return redirect()->route('login.form')
            ->with('red',$msg);
        }
    }
}
