<div>
<nav class="bg-transparent h-24 w-full">
        <div class="flex md:flex-row justify-between items-center text-white w-10/12 mx-auto pt-4">
            <img src="{{ url('images/icons/logo.svg') }}">
            <ul class="flex items-center space-x-6 text-xl">
                <li><a href="{{ route('auth.login') }}"  wire:navigate>Log in</a></li>
                <li class="bg-btnColor px-4 py-2 rounded-md"><a href="{{ route('auth.signup') }}" wire:navigate>Request Access</a></li>
            </ul>
        </div>
</nav>

<img src="{{ asset('images/icons/line.png') }}" class="absolute w-full -top-30 -z-10">
    <!-- Hero section -->
<section class="flex w-10/12 mx-auto mt-10">
        <div class="flex items-center w-8/12">
            <div class="space-y-12 flex flex-col w-10/12">   
                <p class="text-5xl font-bold text-white">Take your video content everywhere</p>
                <small class="text-white text-lg">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil doloribus 
                    eveniet sed ex quisquam repudiandae, eaque deserunt,quas natus accusamus voluptate 
                </small>

                <a href="#" class="bg-btnColor text-white w-6/12 text-center py-6 px-6 rounded-md">Request Access</a>
            </div>
        </div>
        <div>
            <img src="{{ asset('images/icons/hero.png') }}">
        </div>
</section>

<section class="mt-32 space-y-4">
    <p class="text-5xl text-white text-center font-bold">Self distribute with your own website</p>
    <small class="text-center text-lg block mx-auto text-white w-6/12">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima error sed, excepturi distinctio animi dolorem commodi officia possimus reiciendis tempora.</small>
</section>

<!-- slider cards -->

<section class="flex flex-nowrap  space-x-16 mt-28  overflow-x-hidden overflow-y-hidden h-full">

    <div class="w-5/12 rounded-lg flex-shrink-0 relative">   
        <img src="{{ asset('images/icons/man.png') }}" class="block rounded-3xl">
            <div class="absolute top-60 px-12 mt-16 w-12/12 space-y-8 rounded-lg" style="background-image: linear-gradient(transparent,purple 100%)">
                    <p class="text-7xl text-white font-bold text-left">John Brown</p>
                    <p class="text-white  inline">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Assumenda rerum perspiciatis esse quo quos, voluptates beatae autem vero illo alias.</p>
                        <div class="flex space-x-4">
                            <div class="bg-opacity-50 bg-white w-4/12 rounded-md p-3">
                                <img src="{{ asset('images/icons/facebook.png') }}">    
                            </div>
                            <div class="bg-opacity-50 bg-white w-4/12 rounded-md p-3">
                                <img src="{{ asset('images/icons/youtube.png') }}">    
                            </div>
                            <div class="bg-opacity-50 bg-white w-4/12 rounded-md p-3">
                                <img src="{{ asset('images/icons/tiktok.png') }}">    
                            </div>
                        </div>
                    <div>
                        <img src="{{ asset('images/icons/videoimg.png') }}">
                        <div class="flex justify-between text-white font-bold py-1">
                            <p>Making of a music legend</p>
                            <p>$10</p>
                        </div>
                    </div>
            </div>
    </div>

    <div class="w-5/12 rounded-lg flex-shrink-0 relative">   
        <img src="{{ asset('images/icons/man.png') }}" class="block rounded-3xl">
            <div class="absolute top-60 px-12 mt-16 w-12/12 space-y-8 rounded-lg" style="background-image: linear-gradient(transparent,purple 100%)">
                    <p class="text-7xl text-white font-bold text-left">John Brown</p>
                    <p class="text-white  inline">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Assumenda rerum perspiciatis esse quo quos, voluptates beatae autem vero illo alias.</p>
                        <div class="flex space-x-4">
                            <div class="bg-opacity-50 bg-white w-4/12 rounded-md p-3">
                                <img src="{{ asset('images/icons/facebook.png') }}">    
                            </div>
                            <div class="bg-opacity-50 bg-white w-4/12 rounded-md p-3">
                                <img src="{{ asset('images/icons/youtube.png') }}">    
                            </div>
                            <div class="bg-opacity-50 bg-white w-4/12 rounded-md p-3">
                                <img src="{{ asset('images/icons/tiktok.png') }}">    
                            </div>
                        </div>
                    <div>
                        <img src="{{ asset('images/icons/videoimg.png') }}">
                        <div class="flex justify-between text-white font-bold py-1">
                            <p>Making of a music legend</p>
                            <p>$10</p>
                        </div>
                    </div>
            </div>
    </div>

    <div class="w-5/12 rounded-lg flex-shrink-0 relative">   
        <img src="{{ asset('images/icons/man.png') }}" class="block rounded-3xl">
            <div class="absolute top-60 px-12 mt-16 w-12/12 space-y-8 rounded-lg" style="background-image: linear-gradient(transparent,purple 100%)">
                    <p class="text-7xl text-white font-bold text-left">John Brown</p>
                    <p class="text-white  inline">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Assumenda rerum perspiciatis esse quo quos, voluptates beatae autem vero illo alias.</p>
                        <div class="flex space-x-4">
                            <div class="bg-opacity-50 bg-white w-4/12 rounded-md p-3">
                                <img src="{{ asset('images/icons/facebook.png') }}">    
                            </div>
                            <div class="bg-opacity-50 bg-white w-4/12 rounded-md p-3">
                                <img src="{{ asset('images/icons/youtube.png') }}">    
                            </div>
                            <div class="bg-opacity-50 bg-white w-4/12 rounded-md p-3">
                                <img src="{{ asset('images/icons/tiktok.png') }}">    
                            </div>
                        </div>
                    <div>
                        <img src="{{ asset('images/icons/videoimg.png') }}">
                        <div class="flex justify-between text-white font-bold py-1">
                            <p>Making of a music legend</p>
                            <p>$10</p>
                        </div>
                    </div>
            </div>
    </div>
  
</section>

<!-- edgy line -->
<img src="{{ asset('images/icons/edgeline.svg') }}" class="block mx-auto my-32">

<section class="space-y-4">
    <p class="text-5xl text-white text-center font-bold">Take your voice to every platform</p>
    <small class="text-center w-6/12 mx-auto text-white block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum et natus voluptate suscipit temporibus 
        asperiores assumenda tenetur, 
        minus consectetur pariatur!</small>
</section>

<section class="flex items-center justify-center space-x-6 my-10 w-10/12 mx-auto">
    <img src="{{ asset('images/icons/ybox.png') }}" class="block w-fit">
    <img src="{{ asset('images/icons/tbox.png') }}" class="block w-fit">
    <img src="{{ asset('images/icons/ibox.png') }}" class="block w-fit">
    <img src="{{ asset('images/icons/fbox.png') }}" class="block w-fit">
</section>

<!-- wavy line -->
<img src="{{ asset('images/icons/wavy.svg') }}" class="block mx-auto my-32 w-10/12">

<section class="w-11/12 mx-auto flex justify-around">
    <div class="text-white w-6/12 flex flex-col justify-center">
        <p class="text-5xl w-8/12 font-bold">Paid content? No problem</p>
        <p class="mt-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero doloribus ea, eaque voluptatum beatae earum.</p>
    </div>
    <div>   
        <img src="{{ asset('images/icons/price.svg') }}" height="300" width="400">
    </div>

</section>

<section class="text-center text-white mt-28">
    <p class="text-5xl font-bold my-4">Your video,your audience,your money</p>
    <small class="text-lg">All in one place</small>
</section>

<a href="#" class="bg-btnColor py-6 px-6 text-white mx-auto block w-3/12 text-center mt-20">Reuqest access</a>

<img src="{{ asset('images/icons/curve.svg') }}" class="block mx-auto my-32 w-10/12 -mt-6">

<p class="text-white text-center my-10">All right reserved. Fidio {{ date('Y')}}</p>

<script>
    document.addEventListener("DOMContentLoaded",function(){
        let scrollin = document.querySelector(".scrollin");

        scrollin.addEventListener("scroll",function(e){
            console.log("hello")
        })
        
    })


</script>
</div>



