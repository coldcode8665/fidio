<?php

namespace App\Livewire\Dashboard;

use App\Models\Video;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('components.dashboard.layout')]
class Videos extends Component
{
    public $videos;

    public $totalVideos;

    #[Url]
    public $filter = "";

    public function mount(){
        
        $this->totalVideos = Video::where('user_id',auth()->id())->get();

        if($this->filter == ""){
            $this->videos = Video::latest()->where('user_id',auth()->id())->get();
        }else{
            if($this->filter == "all"){
                $this->videos = Video::latest()->where('user_id',auth()->id())->get();
            }else{
                $this->videos = Video::latest()->where('user_id',auth()->id())->where('visibility',$this->filter)->get();
            }
        }
       
    }
    public function delete($id){
        $data = Video::where('id',$id)->first();

        Storage::delete($data->video);
        Storage::delete($data->thumbnail);

        $data->delete();

        return redirect()->route('dashboard.videos');

    }
    
    public function filter($data){
        if($data == 'public'){  
             $this->videos = Video::latest()->where('user_id',auth()->id())->get();
        }else{
             $this->videos = Video::latest()->where('user_id',auth()->id())->where('visibility',$data)->get();
        }
            
    }
   
    public function render()
    {
        return view('livewire.dashboard.videos');
    }
}
