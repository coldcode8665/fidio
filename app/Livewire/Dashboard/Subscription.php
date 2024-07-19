<?php

namespace App\Livewire\Dashboard;

use App\Models\Video;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class Subscription extends Component
{
    public $video;

    public function mount(){
        $this->video = Video::where('user_id',auth()->id())->where('subscribe',true)->get();
    }

    #[Layout('components.dashboard.layout')]
    public function render()
    {
        return view('livewire.dashboard.subscription');
    }
}
