<section class="w-8/12 mx-auto my-16"  x-data="{ uploading: false, progress: 0 }"
        x-on:livewire-upload-start="uploading = true"
        x-on:livewire-upload-finish="uploading = false"
        x-on:livewire-upload-error="uploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">

    <div class="flex justify-between">
        <h1 class="text-3xl text-authBodyColor font-bold">Upload a video</h1>
        <button class="bg-btnColor px-10 py-2 text-white rounded-md shadow-lg" wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled">save</button>
    </div>




        <div x-show="uploading">
            <div class="flex justify-between my-6">
                <p class="text-2xl text-gray-600">Uploading</p>
                <button class="border-2 border-gray-400 rounded-md px-6 py-2">Cancel upload</button>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-btnColor h-2.5 rounded-full" :style="`width: ${progress}%`"></div>
            </div>
        </div>
    

 
    <div class="border-2 border-dotted border-authBodyColor my-10 p-16 space-y-2 rounded-lg relative">
    @if(!$video)
    <center>
            @error('video')
                <p class="text-btnColor">{{ $message }}</p>
            @enderror
    </center>
        <p class="mx-auto  w-8/12 text-center text-2xl font-bold text-navColor">Drag and drop your video here, or <span class="text-btnColor underline"><input type="file" wire:model="video" title=" " class="absolute w-full opacity-0 border top-0 left-0 h-full">click here</span></p>
        <p class="mx-auto  w-8/12 text-center text-navColor">supports MP4, MPEG, AVI (MAX 256 GB)</p>
    @else
    <div>
            <div class="flex justify-between my-6">
                <div>
                    <p class="text-lg text-gray-600 ">Uploaded: <span class="text-sm">{{ $video->getClientOriginalname() }}</span></p>
                </div>
                <button class="border-2 border-gray-400 rounded-md px-6 py-2" wire:click="clearVideo">Delete</button>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-green-600 h-2.5 rounded-full" style="`width: 100%`"></div>
            </div>
    </div>
    
    @endif
    
    </div>

    <div class="space-y-10">
        <div>
          
            <label class="block text-authBodyColor my-2">Video title*</label>
            @error('title')
                <p class="text-btnColor">{{ $message }}</p>
            @enderror
            <input wire:model="title" class="block @error('title') border-red-500 @enderror w-full border p-3 rounded-md shadow-sm focus:outline outline-authBodyColor" type="text" placeholder="Give your video a title">
        </div>
        <div>
            
            <label class="block  text-authBodyColor my-2">Video description*</label>
            @error('description')
                <p class="text-btnColor">{{ $message }}</p>
            @enderror
            <textarea class="block @error('description') border-red-500 @enderror w-full resize-none border h-28 rounded-md focus:outline outline-authBodyColor p-3" placeholder="Enter a description" wire:model="description"></textarea>
        </div>
    </div>

    <!-- #D9D9D9 -->

    <h1 class="text-3xl text-authBodyColor font-bold my-10">Video thumbnail</h1>

    <div class="border flex p-2 justify-between my-4">
        <img src="{{ $thumbnail ? $thumbnail->temporaryUrl() : url('images/icons/thumbnail.png') }}" class="block w-4/12 h-full">

        <div class="w-8/12">
            <div class="w-full h-full flex flex-col justify-center items-center">
            @error('thumbnail')
                <p class="text-btnColor">{{ $message }}</p>
            @enderror
                    <p class="py-2 text-gray-500">Upload a thumbnail for your video</p>
                    <button class="border-4 p-2 rounded-lg relative"> <input type="file" wire:model="thumbnail" class=" absolute opacity-0">Upload a thumbnail</button>
            </div>
        </div>
    </div>

    <hr class="w-full my-12">
    
    <h1 class="text-3xl text-authBodyColor font-bold">Distrubtion</h1>
    <p class="py-2 text-gray-500">Where do you want this video to appear</p>
    @if(session()->has('distroerror'))
        <p>{{ session('distroerror') }}</p>
    @endif
    <div class="w-6/12 space-y-10 mt-10" wire:ignore>
        <div class="bg-gray-100 p-4 rounded-md cover">
            <div class="flex justify-between">
                <div class="w-10/12">
                    <img src="{{ url('images/icons/web.png') }}">
                </div>
                <label class="switch">
                    <input type="checkbox" class="check">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="contents">
                <p class="my-6">You have not setup fidio distribution yet</p>
                <a href="" class="text-btnColor underline">Setup Youtube</a>
            </div>
        </div>
        <div class="bg-gray-100 p-4 rounded-md cover">
            <div class="flex justify-between">
                <div class="w-10/12">
                    <img src="{{ url('images/icons/youtube.png') }}">
                </div>
                <label class="switch">
                    <input type="checkbox" class="check">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="contents">
                <p class="my-6">Select the channels you want to distribute to</p>
                <div class="flex justify-between w-10/12">
                    @if(session()->has("token"))
                        @for($num = 0; $num < count($youtubeData); $num++)
                            <div class="space-y-2">
                                <img src="{{ $youtubeData[$num]['snippet']['thumbnails']['default']['url'] }}" class="mx-auto rounded-full" referrerPolicy="no-referrer">
                                <p>{{ $youtubeData[$num]['snippet']['title'] }}</p>
                                <div class="bg-gray-200  p-2 rounded-full space-x-2">
                                    <input type="checkbox" class="ml-2 box" wire:model="check" value="{{ $youtubeData[$num]['id'] }}"><span class="text-gray-600">select</span>
                                </div>
                            </div>
                        @endfor
                    @else
                        <a href="{{ route('auth.google') }}"class="bg-btnColor rounded-md px-4 py-2 text-white mt-6" wire:click>Connect to YouTube</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-gray-100 p-4 rounded-md cover">
            <div class="flex justify-between">
                <div class="w-10/12">
                    <img src="{{ url('images/icons/facebook.png') }}" class="block">
                </div>
                <label class="switch">
                    <input type="checkbox" class="check">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="contents">
                <p class="my-6">You have not setup facebook distribution yet</p>
                <a href="" class="text-btnColor underline">Setup Facebook</a>
            </div>
        </div>
        <div class="bg-gray-100 p-4 rounded-md cover">
            <div class="flex justify-between">
                <div class="w-10/12">
                <img src="{{ url('images/icons/tiktok.png') }}">
                </div>
                <label class="switch">
                    <input type="checkbox" class="check">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="contents">
                <p class="my-6">You have not setup tiktok distribution yet</p>
                <a href="" class="text-btnColor underline">Setup TikTok</a>
            </div>
        </div>
    </div>

    <hr class="w-full my-12">
    <h1 class="text-3xl text-authBodyColor font-bold">Visibility</h1>
    <p class="py-2 text-gray-500">Who can watch this video</p>

    <div class="flex w-6/12 border justify-center text-center mb-2 rounded-md shadow-md tab" wire:ignore >
        <div class="border-r-2 w-4/12 p-2 public cursor-pointer" >Public</div>
        <div class="border-r-2 w-4/12 p-2 cursor-pointer" >Paid</div>
        <div class="w-4/12 p-2 cursor-pointer" >Subscriber-only</div>
    </div>
    <div class="content mb-12"  wire:ignore>
            <div class="text-authBodyColor hidden">This video will be available to everyone</div>
            <div class="text-authBodyColor hidden">
                <p>This video will be available for a one-off purchase</p>
                <div class="border rounded-md w-6/12 py-4 px-2 my-4">
                    <input type="text" class="w-10/12 border-0 outline-0 h-8" value="$15">
                    <select class="bg-white outline-0 border-0">
                        <option value="USD">USD</option>
                    </select>
                </div>
            </div>
            <div class="text-authBodyColor hidden">Only subscribers will be able to watch this video</div>
        </div>

    <div class="w-full flex justify-end">
        <button class="bg-btnColor text-white px-4 py-2 rounded-md" wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="di">
            save
        </button>
    </div>
<script>

document.addEventListener("livewire:navigated",function(){

let tab = document.querySelector(".tab");
let content = document.querySelector(".content");
let contents = document.querySelectorAll(".contents");
let cover = document.querySelectorAll(".cover");

let check = document.querySelectorAll(".check");


let box = document.querySelector(".box");

if(box){
    box.addEventListener("change",function(){
    if(box.checked){
        @this.dispatch("channel_id",{id:box.getAttribute("value"),distribution:"youtube"});
    }else{

    }
})

}



tab.children[0].addEventListener("click",function(){
    clearTab(0);
    clearContent(0);
    // @this.dispatchSelf("visib",{status:"public"})
    
})
tab.children[1].addEventListener("click",function(){
    clearTab(1);
    clearContent(1);
    // @this.dispatchSelf("visib",{status:"paid"})
    
})
tab.children[2].addEventListener("click",function(){
    clearTab(2);
    clearContent(2);
    // @this.dispatchSelf("visib",{status:"subscribers"})
    
})

function clearTab(count){
    if(count == 0){
        tab.children[1].classList.remove("bg-btnColor");
        tab.children[1].classList.remove("text-white");
        tab.children[2].classList.remove("bg-btnColor");
        tab.children[2].classList.remove("text-white");

        tab.children[count].classList.add("bg-btnColor");
        tab.children[count].classList.add("text-white");
         @this.dispatchSelf("visib",{status:"public"})
    }else if(count == 1){
        tab.children[0].classList.remove("bg-btnColor");
        tab.children[0].classList.remove("text-white");
        tab.children[2].classList.remove("bg-btnColor");
        tab.children[2].classList.remove("text-white");

        tab.children[count].classList.add("bg-btnColor");
        tab.children[count].classList.add("text-white");
         @this.dispatchSelf("visib",{status:"paid"})
    }else{
        tab.children[0].classList.remove("bg-btnColor");
        tab.children[0].classList.remove("text-white");
        tab.children[1].classList.remove("bg-btnColor");
        tab.children[1].classList.remove("text-white");

        tab.children[count].classList.add("bg-btnColor");
        tab.children[count].classList.add("text-white");
         @this.dispatchSelf("visib",{status:"Subscriber-only"})
    }
}

function clearContent(count){
    if(count == 0){
        content.children[1].style.display = "none";
        content.children[2].style.display = "none";

        content.children[count].style.display = "block";
    }else if(count == 1){
        content.children[0].style.display = "none";
        content.children[2].style.display = "none";

        content.children[count].style.display = "block";
    }else{
        content.children[0].style.display = "none";
        content.children[1].style.display = "none";

        content.children[count].style.display = "block";
    }
}
// bg-gray-100 
// p-4 
// rounded-md




    for(let i = 0; i < cover.length; i++){
    cover[i].classList.remove("bg-gray-100")
    cover[i].classList.remove("p-4")
    cover[i].classList.remove("rounded-md")
    contents[i].style.display = "none"; 
}



for(let i = 0; i < check.length; i++){
    check[i].addEventListener("change",function(e){
        if(check[i].checked){
            cover[i].classList.add("bg-gray-100")
            cover[i].classList.add("p-4")
            cover[i].classList.add("rounded-md")
            contents[i].style.display = "block";
        }else{
            cover[i].classList.remove("bg-gray-100")
            cover[i].classList.remove("p-4")
            cover[i].classList.remove("rounded-md")
            contents[i].style.display = "none";
        }
    
    })
}



})
</script>
</section>


