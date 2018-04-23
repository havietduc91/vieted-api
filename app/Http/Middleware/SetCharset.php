<?php

namespace App\Http\Middleware;

use Closure;

class SetCharset
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
        $response = $next($request);
        $response->header('Content-Type', 'text/html; charset=utf-8');

        return $response;
    }
}
