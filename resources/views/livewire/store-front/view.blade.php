<div class="w-10/12 mx-auto text-white">
    @if(!$this->checkSub())
        <div class="fixed w-full h-screen bg-transparent z-10 -top-8 left-0 flex items-center authContainer" wire:ignore>
            <div class="bg-gray-500 w-6/12 p-8 rounded-lg mx-auto" id="login">
                <div class="flex mb-4">
                    <div class="w-full">
                        <img src="{{ asset('images/icons/lock.svg') }}" class="bg-white p-4 rounded-full mx-auto" height="80" width="80" class="mx-auto">
                    </div>
                    <p class="font-bold text-2xl text-white cursor-pointer close">X</p>
                </div>
                <p class="text-3xl text-white font-bold my-8 mt-16">Would you like to become a {{ $website->title }} subscriber?</p>
                <p class="text-white text-xl">Only {{ $website->title."'s" }} subscribers can view this video</p>
                <div class="flex space-x-8 mt-10">
                    <button class="w-6/12 bg-white text-black py-4 rounded-lg subscribe">No</button>
                    <button class="w-6/12 bg-black py-4 rounded-lg subscribe">Yes</button>
                </div>
            </div>
        </div>
    @endif

    @if($currentVideo->price != null)

    <div class="fixed w-full h-screen bg-transparent z-10 -top-8 left-0 flex items-center authContainer" wire:ignore>
        <div class="bg-gray-500 w-6/12 p-8 rounded-lg mx-auto" id="login">
            <div class="flex mb-4">
                <div class="w-full">
                    <img src="{{ asset('images/icons/lock.svg') }}" class="bg-white p-4 rounded-full mx-auto" height="80" width="80" class="mx-auto">
                </div>
                <p class="font-bold text-2xl text-white cursor-pointer close">X</p>
            </div>
            <p class="text-3xl text-white font-bold my-4 mt-16">Pay to view this content</p>
            <p class="text-white text-2xl font-bold">Cost: {{ "$".$currentVideo->price }}/mo</p>
            <div class="text-black flex space-x-8 my-4">
                <div class="w-8/12">
                    <label class="textr-xl my-2 block text-white">Name on Card</label>
                    <input type="text" class="w-full rounded-md py-4 px-2">
                </div>
                <div class="w-4/12">
                    <label class="textr-xl my-2 block text-white">Expiry</label>
                    <input type="number" class="w-full rounded-md py-4 px-2">
                </div>
            </div>
            <div class="text-black flex space-x-8">
                <div class="w-8/12">
                    <label class="textr-xl my-2 block text-white">Card number</label>
                    <input type="text" class="w-full rounded-md py-4 px-2">
                </div>
                <div class="w-4/12">
                    <label class="textr-xl my-2 block text-white">CVV</label>
                    <input type="password" class="w-full rounded-md py-4 px-2" maxlength="4">
                </div>
            </div>
            
            <div class="flex space-x-8 mt-10">
                <button class="w-6/12 bg-white text-black py-4 rounded-lg btn">Cancel</button>
                <button class="w-6/12 bg-black py-4 rounded-lg btn">Pay</button>
            </div>
        </div>
    </div> 
    @endif
    <video class="w-full -z-10" style="height:80vh" {{ $currentVideo->price != null ?  '': "autoplay" }} controls>
    
        <source src="{{ url('storage/'.$currentVideo->video) }}" type="video/mp4" class="-z-10">
        Your browser does not support the video tag.
    </video>
    <p class="text-3xl font-bold">{{ $currentVideo->title }}</p>
    <small class="text-lg my-4 block">{{ $currentVideo->created_at->diffForHumans()}}</small>

    <a href="{{ route('storefront.index',['domain' => $website->domain]) }}" wire:navigate>
        <div class="flex justify-left items-center my-16">
            <img src="{{ url('storage/'.$website->hero_path )}}" class="rounded-full" height="150" width="150" resize="contain">
            <p class="ml-8 font-bold text-xl">{{ $website->title }}</p>
        </div>
    </a>

    <p class="text-lg font-bold">More from {{ $website->title}}</p>

    @if($videos->count() > 0)
    <div class="flex justify-between flex-wrap w-full mx-auto mt-8">
        @foreach($videos as $video)
        
            <div class="w-6/12 px-4 mb-4">
                <a href="{{ route('storefront.view',['video' => $video->id,'website' => $website->domain]) }}" class="inline">
                <div class="flex justify-center items-center" style="height:50vh; background-image: url({{ asset('storage/'.$video->thumbnail) }}); background-repeat:no-repeat; background-size:cover;" class="w-full">
                    <img src="{{ asset('images/icons/Icon.png') }}">
                </div>
                </a>
                <div class="flex justify-between text-white font-bold py-3">
                    <p class="text-3xl w-8/12">{{ $video->title }}</p>
                    @if($video->visibility == 'public')
                    @elseif($video->visibility == 'paid')
                        <p class="text-3xl">{{ '$'.$video->price }}</p>
                    @elseif($video->visibility == 'subscriber-only')
                        @if($video->price)
                            <p class="text-3xl">{{ '$'.$video->price }}</p>
                        @endif
                    @else
                        
                    @endif
                </div>
               
                <p class="text-white">{{ $video->created_at->diffForHumans() }} <small class="mx-2">-</small> {{ $video->views()->count()." ".Str::plural('View',$video->views()->count()) }}</p>
            </div>
        
         @endforeach
    </div>
    @else
    
    @endif


<script>

let subsc = document.querySelectorAll('.subscribe');
let btn = document.querySelectorAll('.btn');

btn.forEach((val) => {
    val.addEventListener('click',function(){
        if(val.textContent == "Cancel"){
            return history.back();
        }
    })
})

subsc.forEach((val) => {
    val.addEventListener('click',function(){
        if(val.textContent == "Yes"){
            @this.dispatch("subscribe",{subscribe:"Yes"});
            @this.on("success",function(e){
                if(e[0].subscribe == true){
                    location.reload();
                }
            })
        }
    })  
})

console.log(history)


</script>
    
</div>
