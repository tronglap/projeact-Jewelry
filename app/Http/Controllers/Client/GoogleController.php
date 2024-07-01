<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate(
            ['google_user_id' => $googleUser->id],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'role' => 0,
                'password' => Hash::make('P@ssword!17102003'),
                'google_user_id' => $googleUser->id
            ]
        );

        // $user = User::where('google_user_id', '=', $googleUser->id)->first();
        // if ($user) {
        //     $user->name = $googleUser->name;
        //     $user->save();
        // } else {
        //     $user = User::create([
        //         'name' => $googleUser->name,
        //         'email' => $googleUser->email,
        //         'role' => 0,
        //         'password' => Hash::make('P@ssword!17102003'),
        //         'google_user_id' => $googleUser->id
        //     ]);
        // }


        Auth::login($user);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}