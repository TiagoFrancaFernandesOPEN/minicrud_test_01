<?php

namespace App\Http\Middleware;

use Closure;
use Log;
class ProfileuserMiddleware
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
        Log::debug('middleware profileuser');
        return $next($request);
    }
}
