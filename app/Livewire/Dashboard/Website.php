<?php

namespace App\Livewire\Dashboard;

use App\Models\Website as Domain;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Website extends Component
{
    use WithFileUploads;
    
    #[Rule('required|image|max:10024')]
    public $image;

    #[Rule('required|min:3|string')]
    public $title;

    #[Rule('required|min:3|string')]
    public $bio;


    public function save(){
        $this->validate();

        $path = $this->image->store('hero');
        
        $data = Domain::where('user_id',auth()->id())->update(
            ['title' => $this->title,'bio' => $this->bio,'hero_path' => $path]
        );

        if($data){
            return redirect()->route('dashboard.distribution');
        }else{
            dd('Oops something went wrong');
        }
    }

    #[Layout('components.dashboard.layout')]
    public function render()
    {
        return view('livewire.dashboard.website');
    }
}
