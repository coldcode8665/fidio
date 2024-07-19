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
        {{-- @if( $toggle->web == 0)
            <div class="text-center my-20 text-xl font-bold text-authBodyColor">
                select a distribution channel to configure or edit
            </div>
        @endif --}}

        <!-- first tab content -->
        <div class="py-10 text-xl text-authBodyColor">
            <div class="flex justify-between py-10 border-b">
                <p class="text-2xl font-bold">Enable website distribution</p>
                <label class="switch">
                    <input type="checkbox" class="checkbox" value="web" {{ $toggle->web == 1 ? 'checked' : ''}} checked>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="content">
                <div class="space-y-2 text-gray-500 border-b pb-8">
                    <p class="text-2xl font-bold my-10 text-authBodyColor">Domain</p>
                    <p>Your fidio domain</p>
                    <p>{{ auth()->user()->website->domain }}.fidio.com</p>
                    <p class="space-x-2 text-btnColor underline"><small class="edit text-xl cursor-pointer ">Edit</small><a href="{{ route('storefront.index',['domain' => auth()->user()->website->domain])}}">Visit</a></p>
                    
                    <div class="w-fit space-y-4 editContent">
                        <p class="text-gray-600 text-3xl">Edit your fidio domain</p>
                        <div class="flex border rounded-md input">
                            <input type="text" class="focus:outline-none p-3 rounded-l-md " wire:model="domain">
                            <p class="border-l p-2 inline text-center">.fidio.com</p>
                        </div>
                       <small class="msg"></small>
                        <div class=" space-x-4">
                            <button class="bg-btnColor py-2 px-4 rounded-md text-white" wire:click="saveDomain">Save</button>
                            <button class="py-2 px-4 border rounded-md text-authBodyColor cancel">Cancel</button>
                        </div>
                    </div>
                </div>

                <div class="border-b pb-10 mb-10">
                    <p class="text-2xl font-bold my-10 text-authBodyColor">Custom Domain</p>
                    <div class="space-x-4">
                        <button class="bg-btnColor rounded-md px-4 py-2 text-white">Buy a domain</button>
                        <button class="border border-gray rounded-md px-4 py-2 ">Connect existing domain</button>
                    </div>
                </div>
                <a href="{{ route('dashboard.website') }}"class="bg-btnColor rounded-md px-4 py-2 text-white">Edit website settings</a>
            </div>
        </div>
        <!-- second tab content -->
        <div class="py-10 text-xl text-authBodyColor" >
            <div class="flex justify-between py-10 border-b">
                <p class="text-2xl font-bold">Enable youtube distribution</p>
                <label class="switch">
                    <input type="checkbox" class="checkbox" value="youtube" {{ $toggle->youtube == 1 ? 'checked' : ''}}>
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


</div>
<script>

    document.addEventListener("livewire:navigated",function(){
        let checkbox = document.querySelectorAll(".checkbox");
        let content = document.querySelectorAll(".content");
        let edit = document.querySelector(".edit");
        let editContent = document.querySelector(".editContent");
        let cancel = document.querySelector(".cancel");
        let input = document.querySelector(".input");
        let msg = document.querySelector(".msg");
      
        editContent.classList.add("hidden");
    
        cancel.addEventListener("click",function(){
            editContent.classList.add("hidden");
            state = 0;
        })
    
        edit.addEventListener("click",function(){
            if(state == 0){
                editContent.classList.remove("hidden");
                state = 1;
            }else{
                editContent.classList.add("hidden");
                state = 0
            }
            
        })
    
    
        content.forEach((val)=>{
            val.classList.add("hidden");
            checkbox.forEach((val,index) => {
                    if(val.checked){
                        content[index].classList.remove("hidden")
                    }else{
                        content[index].classList.add("hidden")
                    }
            })
        })
    
        checkbox.forEach((val,index) => {
            val.addEventListener("change",function(){
                if(val.checked){
                    content[index].classList.remove("hidden")
                    @this.dispatch("tog",{name:val.value,state:true})
                }else{
                    content[index].classList.add("hidden")
                    @this.dispatch("tog",{name:val.value,state:false})
                }
            })
        })

            let state = 0;


            function removeFailed(){
                    input.classList.remove('border-red-600');
                    msg.classList.remove("text-red-600");
            }

            function removeSuccess(){
                    input.classList.remove('border-green-500');
                    msg.classList.remove("text-green-500");
            }

            @this.on('domainMessage',function(e){
                console.log(e[0].status);
                if(e[0].status == 'failed'){
                    removeSuccess();
                    input.classList.add('border-red-600');
                    msg.classList.add("text-red-600");
                    msg.innerHTML = e[0].msg;
                }else{
                    removeFailed();
                    input.classList.add('border-green-500');
                    msg.classList.add("text-green-500");
                    msg.innerHTML = e[0].msg;
                    @this.dispatch("domainTitle",)
                }
            })



    })
    </script>
    