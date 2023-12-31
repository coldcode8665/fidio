<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;


#[Layout('components.auth.layout')]
class Login extends Component
{
    #[Rule('required|email')]
    public $email = "";
    #[Rule('required')]
    public $password = "";
    
    public function store(){
        $this->validate();
        
        if(Auth::attempt(['email' => $this->email,'password' => $this->password])){
            return redirect()->route('dashboard.subscription');
        }else{
            return back()->with(['msg' => "login credentials NOT found"]);
        } 
    }

    public function render()
    {
        return view('livewire.auth.login');
}
}
