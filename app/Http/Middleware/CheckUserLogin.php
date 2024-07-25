<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            if ($user->role === 1 || $user->role === 2) {
                return redirect()->intended(RouteServiceProvider::ADMIN);
            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}