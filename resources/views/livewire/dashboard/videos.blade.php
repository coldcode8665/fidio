
<div class="w-8/12 mx-auto mt-16" id="videobody" >
    @if( count($videos) < 1)
        <h1 class="text-3xl font-bold text-authBodyColor">Videos</h1>
        <section class="w-8/12 mx-auto mt-20 text-center space-y-4">
            <img src="{{ url('images/icons/upload_icon.svg') }}" class="mx-auto">
            <p class="text-2xl font-bold text-authBodyColor">Upload a video to get started</p>
            <p class="-mt-4 text-authBodyColor">Your videos will show up here.</p>
            <a href="{{ route('dashboard.videos.new') }}" class="bg-btnColor px-6 py-4 w-4/12 block mx-auto text-center text-white rounded-md shadow-md" wire:navigate>Upload Video</a>
        </section>
    @else
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold text-authBodyColor">Videos</h1>
            <a class="bg-btnColor px-4 py-2 text-white rounded-md cursor-pointer" href="{{ route('dashboard.videos.new') }}" wire:navigate>Upload Video</a>
        </div>

        <div class="flex justify-end mt-6" wire:ignore>
            <div class="inline">
                <div>
                    <span class="text-authBodyColor font-bold">Filter by:</span>
                    @if(Str::contains(url()->current(),'all'))
                        <a href="{{ route('dashboard.videos.filter',['filter'=>'all']) }}" class="ml-2 text-btnColor underline font-bold cursor-pointer"   wire:navigate>All</a>
                        <a  href="{{ route('dashboard.videos.filter',['filter' => 'Subscriber-only']) }}" class="ml-2 text-btnColor cursor-pointer" wire:navigate>Subscriber-only</a>
                        <a href="{{ route('dashboard.videos.filter',['filter'=>'paid']) }}" class="ml-2 text-btnColor cursor-pointer" value="paid" wire:navigate>Paid</a></div>
                    @elseif(Str::contains(url()->current(),'Subscriber-only'))
                        <a href="{{ route('dashboard.videos.filter',['filter'=>'all']) }}" class="ml-2 text-btnColor  cursor-pointer"   wire:navigate>All</a>
                        <a  href="{{ route('dashboard.videos.filter',['filter' => 'Subscriber-only']) }}" class="ml-2 text-btnColor underline font-bold cursor-pointer" wire:navigate>Subscriber-only</a>
                        <a href="{{ route('dashboard.videos.filter',['filter'=>'paid']) }}" class="ml-2 text-btnColor cursor-pointer" value="paid" wire:navigate>Paid</a></div>
                    @elseif(Str::contains(url()->current(),'paid'))
                        <a href="{{ route('dashboard.videos.filter',['filter'=>'all']) }}" class="ml-2 text-btnColor  cursor-pointer"   wire:navigate>All</a>
                        <a  href="{{ route('dashboard.videos.filter',['filter' => 'Subscriber-only']) }}" class="ml-2 text-btnColor  cursor-pointer" wire:navigate>Subscriber-only</a>
                        <a href="{{ route('dashboard.videos.filter',['filter'=>'paid']) }}" class="ml-2 text-btnColor underline font-bold cursor-pointer" value="paid" wire:navigate>Paid</a></div>
                    @else
                        <a href="{{ route('dashboard.videos.filter',['filter'=>'all']) }}" class="ml-2 text-btnColor  underline font-bold cursor-pointer"   wire:navigate>All</a>
                        <a  href="{{ route('dashboard.videos.filter',['filter' => 'Subscriber-only']) }}" class="ml-2 text-btnColor  cursor-pointer" wire:navigate>Subscriber-only</a>
                        <a href="{{ route('dashboard.videos.filter',['filter'=>'paid']) }}" class="ml-2 text-btnColor  cursor-pointer" value="paid" wire:navigate>Paid</a></div>
                    @endif
                </div>
        </div>

        <table class="w-full mt-10 h-auto">
                <tr class="text-left text-gray-600 border-b uppercase text-xl">
                    <th class="pb-4 text-lg  ">Video</th>
                    <th class="pb-4 text-lg  text-center">Distribution</th>
                    <th class="pb-4 text-lg  text-center">Views</th>
                    <th class="pb-4 text-lg text-center">Visibility</th>
                </tr>
            <tbody>
                @foreach( $videos as $video)
                    <tr class="my-6 border-b hover:bg-gray-100 relative vi hidden">
                        <td class="flex my-4 mx-2 ">
                            <img src="{{ asset('storage/'.$video->thumbnail) }}" class="w-24 h-24 rounded-md">
                            <div class="mx-6">
                            <h3 class="text-2xl font-bold text-gray-600">{{ $video->title }}</h3>
                            <p class="text-lg text-gray-600">{{ $video->description }}</p>
                            <small class="text-gray-600">{{$video->created_at->diffForHumans() }}</small>
                            </div>
                        </td>
                        <td class="my-4 mx-2 ">
                            <img src="{{ asset('images/icons/youtube_icon.png') }}" class="block mx-auto">
                        </td>
                        <td class="my-4 mx-2 text-center">
                        ---
                        </td>
                        <td class="my-4 mx-2 text-center">
                            <p class="text-gray-600 mx-auto">{{ $video->visibility }}</p>
                        </td>
                        <td wire:ignore>
                            <span class="font-bold text-2xl cursor-pointer option" id="option">...</span>
                            <div class="absolute w-3/12 rounded-md shadow-md bg-white right-3 z-10 p-2 space-y-4 optionValue hidden">
                                <div class="flex space-x-4 hover:bg-gray-100 p-2 rounded-md text-gray-600 cursor-pointer">
                                    <img src="{{ asset('images/icons/edit.png') }}">
                                    <p class=>View video details</p>
                                </div>
                                <div class="flex space-x-4 hover:bg-gray-100 p-2 rounded-md text-gray-600 cursor-pointer" wire:click="delete({{ $video->id }})">
                                    <img src="{{ asset('images/icons/trash.png') }}">
                                    <p>Delete Permanently</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="w-2/12 mx-auto border-4 text-authBodyColor cursor-pointer rounded-md text-center py-2 my-4 loadmore"> load more </div>
    @endif
</div>

<script>
document.addEventListener("livewire:navigated",function(){
       
        let option = document.querySelectorAll(".option");
        let optionValue = document.querySelectorAll(".optionValue");
        let vi = document.querySelectorAll(".vi");
        let loadmore = document.querySelector(".loadmore");
        let body = document.querySelector("#videobody");
        let visibility = vi.length < 4 ? vi.length : 4;
        let state = 0


    
document.addEventListener('click',function(event){

    if(event.target.id !== 'option'){
         optionValue.forEach((res) => {
            res.classList.add('hidden');
        })
    }
   
})




        if(vi.length < 5){
            loadmore.classList.add('hidden');
        }

        function view(){
            for(let i = 0; i < visibility; i++){
                vi[i].classList.remove("hidden");
            }
        }

        view();

        loadmore.addEventListener('click',function(){
            visibility += 4;
            view();
        })
                option.forEach((value) => {
                    value.addEventListener("click",function(){
                       
                        optionValue.forEach((res) => {
                            res.classList.add('hidden');
                        })
                        value.nextElementSibling.classList.remove('hidden');
                        state = 1;
                    })
                }) 
                


})
</script>