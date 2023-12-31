<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Http;

#[Layout('components.dashboard.layout')]
class Distribution extends Component
{
    public $youtubeData;
    
    public function mount(){
        if(session()->has("token")){
            $response = Http::withToken(session('token'))->get('https://www.googleapis.com/youtube/v3/channels', [
                'part' => 'snippet,contentDetails,brandingSettings',
                'mine' => true
                // 'key' => env('YOUTUBE') 
            ]);
            $data = $response->json();

            $this->youtubeData = $data['items'];
        }
    }

    public function google_auth(){
        return redirect()->route("auth.google");
    }
   
    public function render()
    {
        return view('livewire.dashboard.distribution');
    }
}
