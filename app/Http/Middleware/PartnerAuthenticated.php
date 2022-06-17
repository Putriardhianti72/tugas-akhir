<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\Partner\Auth;

class PartnerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role = '')
    {
        $role = $role ?: Auth::ROLE_MEMBER;

        if ($role === Auth::ROLE_MEMBER) {
            return $this->handleMember($request, $next);
        }

        return $this->handleAdmin($request, $next);
    }

    protected function handleMember(Request $request, Closure $next)
    {
        if (member_auth()->check()) {
            return $next($request);
        }

        if (! $request->expectsJson()) {
            return redirect()->route('login');
        }

        abort(403, 'Forbidden');
    }

    protected function handleAdmin(Request $request, Closure $next)
    {
        if (admin_auth()->check()) {
            return $next($request);
        }

        if (! $request->expectsJson()) {
            return redirect()->route('admin.login');
        }

        abort(403, 'Forbidden');
    }
}
