<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();
        $avatar = $user->getAvatar();

        $user = \App\Models\User::where('email', '=', $user->email)->first();

        if ($user) {
            Auth::login($user);
            return view('google-logged-in', [
                'user' => $user,
                'avatar' => $avatar,
            ]);
        } else {
            return view('google-logged-in', [
                'user' => null
            ]);
        }
    }

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $avatar = $user->getAvatar();

        $user = \App\Models\User::firstOrCreate([
            'email' => $user->email,
        ], [
            'name' => $user->getName(),
            'password' => bcrypt('12345'),
        ]);

        if ($user) {
            Auth::login($user);
            return view('facebook-logged-in', [
                'user' => $user,
                'avatar' => $avatar,
            ]);
        } else {
            return view('facebook-logged-in', [
                'user' => null
            ]);
        }
    }
}
