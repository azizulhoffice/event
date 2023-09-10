<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JudgeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and their role is "judge"
        if (auth()->check() && auth()->user()->role === 'judge') {
            return $next($request);
        }

        return abort(404);
    }
}
