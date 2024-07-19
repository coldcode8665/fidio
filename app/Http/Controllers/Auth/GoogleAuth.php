<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuth extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->scopes([
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/youtube.download',
            'https://www.googleapis.com/auth/youtube.readonly',
            'https://www.googleapis.com/auth/youtube.upload',
            'https://www.googleapis.com/auth/youtube.force-ssl',
            'https://www.googleapis.com/auth/youtubepartner-channel-audit',
            'https://www.googleapis.com/auth/youtube.upload',
            'https://www.googleapis.com/auth/youtube.channel-memberships.creator',
            'https://www.googleapis.com/auth/youtube.third-party-link.creator',
            'https://www.googleapis.com/auth/youtubepartner-channel-audit'
            ])->redirect();
        
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

      if(User::where('google_id',$user->user['id'])->first() == null){
             $reg =  User::create([
            'name' => $user->user['name'],
            'email' => $user->user['email'],
            'password' => Hash::make(''),
            'google_id' => $user->user['id'],
            'profile' => $user->user['picture']
            ]);
           
        if($reg){
            $data = User::where('google_id',$user->user['id'])->first();
            session(['token' => $user->token]);
            Website::create(['user_id' => $data->id,'domain' => str_replace(' ',"",strtolower($user->user['name']))]);
            Auth::login($data);
            
            if(session()->has('video')){
                return redirect()->route('dashboard.videos.new');
            }else{
                return redirect()->route('dashboard.subscription');
            }
        }else{
            return back()->with(['msg' => "Oops something went wrong"]);
        }
      }else{
            $data = User::where('google_id',$user->user['id'])->first();
            session(['token' => $user->token]);
            Auth::login($data);

            if(session()->has('video')){
                return redirect()->route('dashboard.videos.new');
            }else{
                return redirect()->route('dashboard.subscription');
            }
       
      }

    // You can now work with the $user data, such as creating or logging in the user.
    }
}
