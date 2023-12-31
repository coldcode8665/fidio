<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class Dashboard extends Controller
{
    public function index(){
        $user = Socialite::driver('google')->user();
        dd($user);
        return view("dashboard");
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        dd($user);

    // You can now work with the $user data, such as creating or logging in the user.
    }
}
