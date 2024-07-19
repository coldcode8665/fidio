<div class="w-8/12 mx-auto mt-16 ">
    <h1 class="text-3xl font-bold text-authBodyColor">Subscriptions</h1>
<div class="flex justify-between mt-10">
            <h1 class="text-xl text-authBodyColor">select videos</h1>
                <button class="bg-btnColor px-4 py-2 text-white rounded-md cursor-pointer save">save changes</button>
</div>

        <!-- Modal -->

        <div class="hidden w-full  h-screen items-center justify-center bg-black bg-opacity-50 absolute top-0 left-0 bottom-0 z-10 modal" id="modal">
                <div class="bg-white mx-auto my-64 w-3/12 rounded-md p-6 setup">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg w-9/12 text-center mx-auto text-authBodyColor">Set your monthly subscription price</h1>
                        <div class="text-authBodyColor font-bold cursor-pointer modalCancel" id="close">X</div>
                    </div>
                    <div class="text-center text-sm text-authBodyColor mt-4"> how much do you want your paid subscriber-only content to cost</div>
                    <div class="border rounded-md w-full py-4 px-2 my-4">
                        <input type="text" class="w-10/12 border-0 outline-0 h-6 amount" placeholder="Amount">
                        <select class="bg-white outline-0 border-0">
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <button class="bg-btnColor w-full py-2 text-white rounded-md submit">Save</button>
                </div>
                <div class="bg-white mx-auto my-64 w-3/12 rounded-md p-6 success">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg w-9/12 text-center mx-auto text-authBodyColor">Subscription enabled!</h1>
                        <div class="text-authBodyColor font-bold cursor-pointer modalCancel" id="closeSub">X</div>
                    </div>
                    <div class="text-center text-sm text-authBodyColor my-4"> Congratulations! your subscription has beeen set up</div>
                    <button class="bg-btnColor w-full py-2 text-white rounded-md savelink">Okay</button>
                </div>
        </div>

        <!-- end of modal -->



        <table class="w-full mt-14 h-auto">
                <tr class="text-left text-gray-600 border-b uppercase text-xl">
                    <th class="pb-4 text-lg  "></th>
                    <th class="pb-4 text-lg  ">Video</th>
                    <th class="pb-4 text-lg  text-center">Distribution</th>
                    <th class="pb-4 text-lg  text-center">Views</th>
                    <th class="pb-4 text-lg text-center">Visibility</th>
                </tr>
            <tbody>
                @foreach( $videos as $video)
                    <tr class="my-6 border-b hover:bg-gray-100 relative vi hidden">
                        <td><input type="checkbox" value="{{ $video->id }}" class="checkbox"  {{ $video->visibility == "Subscriber-only" ? 'checked' : ''}} {{ $video->visibility != "Subscriber-only" && $video->price != null ? 'checked' : ''}} {{ $video->price != null ? 'disabled' : ''}}></td>
                        <td class="flex my-4 mx-2 w-10/12">
                            <img src="{{ asset('storage/'.$video->thumbnail) }}" class="w-24 h-24 rounded-md">
                            <div class="mx-6">
                            <h3 class="text-2xl font-bold text-gray-600">{{ $video->title }}</h3>
                            <p class="text-lg text-gray-600">{{ $video->description }}</p>
                            <small class="text-gray-600">{{$video->created_at->diffForHumans() }}</small>
                            </div>
                        </td>
                        <td class="my-4 mx-2 w-2/12">
                            <div class="flex justify-center items-center space-x-4">
                                <img src="{{ asset('images/icons/web.svg') }}" class="">
                                @if($video->youtube) 
                                    <img src="{{ asset('images/icons/youtube_icon.png') }}" class="">
                                @endif
                            </div>
                        </td>
                        <td class="my-4 mx-2 text-center w-2/12">
                        ---
                        </td>
                        <td class="my-4 mx-2 text-center w-2/12">
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
</div>
<script>
document.addEventListener("livewire:navigated",function(){
       
        let option = document.querySelectorAll(".option");
        let optionValue = document.querySelectorAll(".optionValue");
        let vi = document.querySelectorAll(".vi");
        let loadmore = document.querySelector(".loadmore");
        let body = document.querySelector("#videobody");

        let data = [];
        let record = [];

        let save = document.querySelector(".save");
        let saveLink = document.querySelector(".savelink");
        let submit = document.querySelector(".submit");
        let close = document.querySelector(".close");

        // if(record.length < 1){
        //     save.setAttribute('disabled',true);
        //     save.classList.add('bg-gray-300');
        // }

        let setup = document.querySelector(".setup");
        let success = document.querySelector(".success");
            success.classList.add("hidden");
        let amount = document.querySelector(".amount");

        let modal = document.querySelector(".modal");
        let modalcancel = document.querySelectorAll(".modalCancel");
        let checkbox = document.querySelectorAll(".checkbox");
        
        let visibility = vi.length < 4 ? vi.length : 4;
        let state = 0;
        let id;
        modal.addEventListener('click',function(event){
            if(event.target.id == 'modal'){
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        })


        save.addEventListener('click',function(){
            record = [];
            checkbox.forEach((val) => {
                if(val.checked && val.disabled == false){
                    record.push(val.value);
                    console.log(record)
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    success.classList.add('hidden');
                    setup.classList.remove('hidden');
                }
        })
    })

        submit.addEventListener("click",function(){
            let validate = /^\d+$/
            if(validate.test(parseInt(amount.value))){
                data.push({ids:record,amount:amount.value});
                success.classList.remove('hidden');
                setup.classList.add('hidden');
                console.log(data);
            }
        })

        saveLink.addEventListener('click',function(){
            @this.dispatch('price',{data});
        })

        // save[1].addEventListener('click',function(){
        //     modal.classList.add('hidden');
        // })

        // saveLink.addEventListener("click",function(){
        //     @this.dispatch('price',{data});
        // })

        
        // modalcancel[0].addEventListener('click',function(event){
        //     if(event.target.id == 'close'){
        //         modal.classList.add('hidden');
        //     }
        // })
        // modalcancel[1].addEventListener('click',function(event){
        //     if(event.target.id == 'closeSub'){
        //         modal.classList.add('hidden');
        //     }
        // })
        
    
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
