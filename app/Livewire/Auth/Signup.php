<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


#[Layout('components.auth.layout')]
class Signup extends Component
{
    #[Rule('required|min:3')]
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
            return redirect()->route('dashboard.subscription');
        }else{
            return back()->with(['msg' => "Oops something went wrong"]);
        }

    }
    public function render()
    {
        return view('livewire.auth.signup');
    }
}
