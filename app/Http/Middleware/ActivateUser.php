<?php

namespace App\Http\Middleware;

use Closure;

class ActivateUser
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
        if(\Auth::user()->subscription->status == "active"){
            return redirect("member/dashboard");
        }
        return $next($request);
    }
}
