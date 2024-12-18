<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Http\Request;
use Str;
use Symfony\Component\HttpFoundation\Response;

class DialogflowMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cookie::get('dialogflow_session') === null)
            Cookie::queue(
                'dialogflow_session',
                Str::random(16),
                60 * 24
            );

        return $next($request);
    }
}
