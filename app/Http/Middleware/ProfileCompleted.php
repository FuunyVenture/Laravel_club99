<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class ProfileCompleted
{
    /**
     * Redirect to profile form if user not have home_address completed.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::guard()->guest()) {
            if (!isset(\Auth::user()->home_address)) {
                /*return redirect('member/profile')->withErrors(['error' => 'Your must complete your profile before do any action on Club99']);*/
                $request->session()->set('profile_completed', false );
                return redirect('member/subscription');
            }
        }
        return $next($request);
    }
}