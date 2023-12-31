<div class="w-8/12 mx-auto mt-16" >
    <h1 class="text-3xl font-bold text-authBodyColor">Distribution</h1>
    <section class="flex w-full justify-center mt-10 tab">
        <div class="border w-4/12 mr-6 p-2 rounded-md">
            <img src="{{ url('images/icons/website.png') }}">
        </div>
        <div class="border w-4/12 mr-6 p-2 rounded-md">
            <img src="{{ url('images/icons/youtube.png') }}">
        </div>
        <div class="border w-4/12 mr-6 p-2 rounded-md">
            <img src="{{ url('images/icons/facebook.png') }}">
        </div>
        <div class="border w-4/12 mr-6 p-2 rounded-md">
            <img src="{{ url('images/icons/tiktok.png') }}">
        </div>
    </section>

    <section class="tabcontent" wire:ignore>
        <!-- first screen on landing -->
        <div class="text-center my-20 text-xl font-bold text-authBodyColor">
            select a distribution channel to configure or edit
        </div>

        <!-- first tab content -->
        <div class="py-10 text-xl text-authBodyColor">
            <div class="flex justify-between py-10 border-b">
                <p class="text-2xl font-bold">Enable website distribution</p>
                <label class="switch">
                    <input type="checkbox" class="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="content">
                <div class="space-y-2 text-gray-500 border-b pb-8">
                    <p class="text-2xl font-bold my-10 text-authBodyColor">Domain</p>
                    <p>Your fidio domain</p>
                    <p>flagrant.video.com</p>
                    <p class="space-x-2 text-btnColor underline"><a href="">Edit</a><a href="">Visit</a></p>
                </div>

                <div class="border-b pb-10 mb-10">
                    <p class="text-2xl font-bold my-10 text-authBodyColor">Custom Domain</p>
                    <div class="space-x-4">
                        <button class="bg-btnColor rounded-md px-4 py-2 text-white">Buy a domain</button>
                        <button class="border border-gray rounded-md px-4 py-2 ">Connect existing domain</button>
                    </div>
                </div>
                <button class="bg-btnColor rounded-md px-4 py-2 text-white">Edit website settings</button>
            </div>
        </div>
        <!-- second tab content -->
        <div class="py-10 text-xl text-authBodyColor" >
            <div class="flex justify-between py-10 border-b">
                <p class="text-2xl font-bold">Enable youtube distribution</p>
                <label class="switch">
                    <input type="checkbox" class="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="content">
                @if(session()->has("token"))
                <div class="contents">
                    <p class="my-6">Select the channels you want to distribute to</p>
                    <div class="flex justify-between w-6/12">
                        @for($num = 0; $num < count($youtubeData); $num++)
                            <div class="space-y-2">
                                <img src="{{ $youtubeData[$num]['snippet']['thumbnails']['default']['url'] }}" class="mx-auto rounded-full">
                                <p>{{ $youtubeData[$num]['snippet']['title'] }}</p>
                                <div class="bg-gray-200  p-2 rounded-full space-x-2">
                                    <input type="checkbox" class="ml-2"><span class="text-gray-600">select</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <button class="bg-btnColor rounded-md px-4 py-2 text-white mt-6" wire:click="youtube">Save</button>
                </div>
                @else
                    <button class="bg-btnColor rounded-md px-4 py-2 text-white mt-6" wire:click="google_auth">Connect to YouTube</button>
                @endif
            </div>
        </div>
    </section>

<script>

document.addEventListener("livewire:navigated",function(){
    let checkbox = document.querySelectorAll(".checkbox");
    let content = document.querySelectorAll(".content");


    content.forEach((val)=>{
        val.classList.add("hidden");
    })

    checkbox.forEach((val,index) => {
        val.addEventListener("change",function(){
            if(val.checked){
                content[index].classList.remove("hidden")
            }else{
                content[index].classList.add("hidden")
            }
        })
    })
})
</script>

</div>