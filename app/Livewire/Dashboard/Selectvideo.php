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

    public function delete($id){
        $data = Video::where('id',$id)->first();

        Storage::delete($data->video);
        Storage::delete($data->thumbnail);

        $data->delete();

        return redirect()->route('dashboard.subscription');
    }

    #[On('price')]
    public function setPrice($data){
       for($num = 0; $num < count($data); $num++){
            Video::where('id',$data[$num]['id'])->update(['price' => $data[$num]['amount']]);
       }
       return redirect()->route('dashboard.subscription');
    }

    #[Layout('components.dashboard.layout')]
    public function render()
    {
        $videos = Video::latest()->where('user_id',auth()->id())->get();
        return view('livewire.dashboard.selectvideo')->with(['videos' => $videos]);
    }
}
