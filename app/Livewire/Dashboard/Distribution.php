<?php

namespace App\Livewire\Dashboard;

use App\Models\Website;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Distribution as Distro;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Http;

#[Layout('components.dashboard.layout')]
class Distribution extends Component
{
    public $youtubeData;

    // #[Rule('required|string|max:15|min:3')]
    public $domain;

    public $domainName = "No-Domain";

    public $toggle;
    
    public function mount(){
        
        $this->toggle = Distro::where('user_id',auth()->id())->first();

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

    public function saveDomain(){
        $this->validate(['domain' => 'required|min:3|max:15']);

        $record = Website::where('domain',str_replace(' ','',$this->domain))->count();

        if($record == 0){
            $data = Website::where('user_id',auth()->id())->update(['domain' => str_replace(' ','',$this->domain)]);
            if($data){
                $this->dispatch('domainMessage',['status' => "success","msg" => "Domain updated successfully."]);
            }
        }else{
            $this->dispatch('domainMessage',['status' => "failed","msg" => "this domain is already taken."]);
        }

    }

    #[On('tog')]
    public function toggler($name,$state){
        $data = Distro::where('user_id',auth()->id())->count();
        if($data > 0){
            Distro::where('user_id',auth()->id())->update(["$name" => $state]);
        }else{
            Distro::create([
                'user_id' => auth()->id(),
                "$name",$state
            ]);
        }
    }
   
    public function render()
    {
        return view('livewire.dashboard.distribution');
    }
}
