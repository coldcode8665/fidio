<?php

namespace App\Livewire\StoreFront;

use App\Models\Guest;
use App\Models\Video;
use App\Models\Website;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Layout('components.layouts.storefront')]
class Index extends Component
{
    public $data;

    public $videos;

    public $username;
    public $regemail;
    public $regpassword;

    protected $listeners = ['storeRegister'];

    public function mount($domain){
        $data = Website::where('domain',$domain)->first();
        if($data){
            $video = Video::where('user_id',$data->user_id)->get();
            $this->videos = $video;
            $this->data = $data;
        }else{
            return redirect()->route("index");
        }
    }  
    
    #[On('login')]
    public function storeLogin($email,$password){
        if(auth('user')->attempt(['email' => $email,'password' => $password])){
            $this->dispatch('loginSuccess');
        }else{
            $this->dispatch('loginError',['message' => "Invalid login credentials"]);
        } 
    }

    #[On('save')]
    public function storeRegister($username,$email,$password){
        // dd("coming");
        

        $user = Guest::where('email',$email)->count();

        if($user > 0){
            $this->dispatch('reg',["msg"=>"User already exist"]);
        }else{
            Guest::create(['username' => $username,'email' => $email, 'password' => Hash::make($password)]);
            if(auth('user')->attempt(['email' => $email,'password' => $password])){
                $this->dispatch('done');
            }
        }
       
    }


    
    public function render()
    {
        return view('livewire.store-front.index');
    }
}
