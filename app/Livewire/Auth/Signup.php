<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Website;
use Livewire\Component;
use App\Models\Distribution;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


#[Layout('components.auth.layout')]
class Signup extends Component
{
    #[Rule('required|min:3|unique:users')]
    public $name = "";
    #[Rule('required|email|unique:users')]
    public $email = "";
    #[Rule('required')]
    public $password_confirmation = ""; 
    #[Rule('required|confirmed')]
    public $password = "";


    public function store(){
    
        $this->validate();

        User::create([
            "name" => $this->name,
            "email" => $this->email,
            "password" => Hash::make($this->password)
        ]);

        

        if(Auth::attempt(['email'=>$this->email,'password' => $this->password])){
            $domain = Website::create(['user_id' => auth()->id(),'domain' => str_replace(' ',"",strtolower($this->name))]);
            Distribution::create(['user_id' => auth()->id()]);
            if($domain){
                return redirect()->route('dashboard.subscription');
            }  
        }else{
            return back()->with(['msg' => "Oops something went wrong"]);
        }

    }
    public function render()
    {
        return view('livewire.auth.signup');
    }
}
