<?php

namespace App\Livewire\Auth;
use Livewire\Attributes\Layout;

use Livewire\Component;

class Passwordreset extends Component
{
    #[Layout('components.auth.layout')]
    public function render()
    {
        return view('livewire.auth.passwordreset');
    }
}
