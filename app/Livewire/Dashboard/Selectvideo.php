<?php

namespace App\Livewire\Dashboard;

use App\Models\Video;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

class Selectvideo extends Component
{
    public $data = [];

    public $id = [];

    public $videos;

    public function delete($id){
        $data = Video::where('id',$id)->first();

        Storage::delete($data->video);
        Storage::delete($data->thumbnail);

        $data->delete();

        return redirect()->route('dashboard.subscription');
    }

    #[On('price')]
    public function setPrice($data){
        // $data[0]['ids'];
       for($num = 0; $num < count($data[0]['ids']); $num++){
            Video::where('id',$data[0]['ids'][$num])->update(['price' => $data[0]['amount'],'subscribe' => true]);
       }
       return redirect()->route('dashboard.subscription');
    }

    public function save(){
        dd($this->id);
    }

    public function mount(){

        $this->videos = Video::latest()->where('user_id',auth()->id())->whereIn('visibility',['public','Subscriber-only'])->get();
    }

    #[Layout('components.dashboard.layout')]
    public function render()
    {
        
        return view('livewire.dashboard.selectvideo');
    }
}
