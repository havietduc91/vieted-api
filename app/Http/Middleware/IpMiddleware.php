<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
{
    const ACCEPT_IPS = ['127.0.0.1'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!in_array($request->ip(), self::ACCEPT_IPS)) {
            return redirect('home');
        }

        return $next($request);
    }
}
