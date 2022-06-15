<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MemberAuthenticated
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
        if (member_auth()->check()) {
            return $next($request);
        }

        if (! $request->expectsJson()) {
            return redirect()->route('login');
        }

        abort(403, 'Forbidden');
    }
}
