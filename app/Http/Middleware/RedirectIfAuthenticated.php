<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request and redirect users by roles.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->role->name === 'Admin' || Auth::user()->role->name === 'Sub Admin') {
                return redirect('admin/dashboard');
            }

            return redirect('member/dashboard');
        }

        return $next($request);
    }
}
