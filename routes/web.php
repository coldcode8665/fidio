<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Domain;
use App\Livewire\Auth\Signup;
use App\Livewire\Dashboard\Index;
use App\Livewire\Dashboard\Videos;
use App\Livewire\Auth\Passwordreset;
use App\Livewire\Dashboard\NewVideo;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Passwordresetdone;
use App\Livewire\Dashboard\Distribution;
use App\Livewire\Dashboard\Subscription;
use App\Http\Controllers\Auth\GoogleAuth;
use App\Livewire\Dashboard\Selectvideo;
use App\Livewire\Landing\Index as LandingIndex;

//Auth Routes
Route::middleware('guest')->group(function(){
    Route::get("/login",Login::class)->name("auth.login");
    Route::get("/signup",Signup::class)->name("auth.signup");
    Route::get("/domain",Domain::class)->name("auth.domain");
    Route::get("/password/reset",Passwordreset::class)->name("auth.passwordreset");
    Route::get("/password/email/sent",Passwordresetdone::class)->name("auth.passwordrese.sent");
    Route::get("/",LandingIndex::class)->name("index");
});

//Google Auth Routes
Route::get("/google/signin",[GoogleAuth::class,"redirectToGoogle"])->name("auth.google");
Route::get("/authenticate",[GoogleAuth::class,"handleGoogleCallback"])->name("auth.google.confirm");

//Dashboard Routes
Route::middleware("auth")->group(function(){
    Route::get("/dashboard",Index::class)->name("dashboard");
    Route::get("/subscription",Subscription::class)->name("dashboard.subscription");
    Route::get("/subscription/select",Selectvideo::class)->name("dashboard.subscription.select");
    Route::get("/videos",Videos::class)->name("dashboard.videos");
    Route::get("/videos/filter/{filter}",Videos::class)->name("dashboard.videos.filter");
    Route::get("/new/videos", NewVideo::class)->name("dashboard.videos.new");
    Route::get("/distribution", Distribution::class)->name("dashboard.distribution");
});
//logout

Route::get("/logout",function(){
    auth()->logout();
    session(['token' => null]);
    return redirect()->route('auth.login');
})->name("logout");