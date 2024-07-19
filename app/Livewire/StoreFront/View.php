<?php

namespace App\Livewire\StoreFront;

use App\Models\View as VideoView;
use App\Models\Video;
use App\Models\Website;
use Livewire\Component;
use App\Models\Subscribe;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.storefront')]
class View extends Component
{
    public $currentVideo;
    public $website;
    public $videos;

    public function mount($website,$video){
        $this->currentVideo = Video::where('id',$video)->first();
        $this->website = Website::where('domain',$website)->first();

        $this->videos = Video::where('user_id',$this->website->user_id)->where('id','!=',$video)->get();

        if(VideoView::where('video_id',$this->currentVideo->id)->where('guest_id',auth('user')->id())->count() == 0){
            VideoView::create(['video_id' => $this->currentVideo->id,'guest_id' => auth('user')->id()]);
        }
    }
    #[On('subscribe')]
    public function subscription($subscribe){
        $sub = Subscribe::create(['user_id' => $this->website->user_id,'guest_id' => auth('user')->id()]);

        if($sub){
            $this->dispatch('success',['subsribe' => true]);
        }
        
    }

    public function checkSub(){
        $sub = Subscribe::where('user_id',$this->website->user_id)->where('guest_id',auth('user')->id())->count();
         if($sub){
            return true;
         }else{
            return false;
         }
    }

    public function cancel(){
        return redirect()->route('storefront.index',['domain' => $this->website->domain]);
    }
    public function render()
    {
        return view('livewire.store-front.view');
    }
}
