<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAdminStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('home.register');
        }

        $user = Auth::user();
        if ($user->role === 2) {
            return redirect()->route('admin.index')->with('message', 'Tài khoản của bạn chưa được cấp quyền để thực hiện tác vụ này.');
        }

        return $next($request);
    }
}