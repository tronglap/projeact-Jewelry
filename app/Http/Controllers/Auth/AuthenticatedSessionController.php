<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Xác thực thông tin đăng nhập
        $request->authenticate();

        // Tái tạo lại session
        $request->session()->regenerate();

        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Điều hướng dựa trên vai trò của người dùng
        if ($user->role === 1 || $user->role === 2) {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('home');
    }
}
