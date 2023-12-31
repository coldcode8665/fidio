<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ url('css/toggle.css') }}">
    <livewire:styles>
</head>
<body class="relative">
<nav class="bg-navColor h-24 w-full">
        <div class="flex md:flex-row justify-between items-center text-white w-10/12 mx-auto pt-4">
            <img src="{{ url('images/icons/logo.svg') }}">
            <ul class="flex space-x-6 text-xl">
                @if(str()->contains(url()->current(),'dashboard'))
                    <li class="text-white hover:text-white"><a href="" wire:navigate>Dashboard</a></li>
                @else
                    <li class="text-gray-400 hover:text-white"><a href="" wire:navigate>Dashboard</a></li>
                @endif
                @if(str()->contains(url()->current(),'videos'))
                    <li class="text-white hover:text-white"><a href="{{ route('dashboard.videos') }}" class="" wire:navigate>Videos</a></li>
                @else
                    <li class="text-gray-400 hover:text-white"><a href="{{ route('dashboard.videos') }}" class="" wire:navigate>Videos</a></li>
                @endif

                @if(str()->contains(url()->current(),'subscription'))
                    <li class="text-white hover:text-white"><a href="{{ route('dashboard.subscription') }}"  wire:navigate>Subscriptions</a></li>
                @else
                    <li class="text-gray-400 hover:text-white"><a href="{{ route('dashboard.subscription') }}" wire:navigate>Subscriptions</a></li>
                @endif
                @if(str()->contains(url()->current(),'distribution'))
                    <li class="text-white hover:text-white"><a href="{{ route('dashboard.distribution') }}" class="" wire:navigate>Distribution</a></li>
                @else
                    <li class="text-gray-400 hover:text-white"><a href="{{ route('dashboard.distribution') }} " class="" wire:navigate>Distribution</a></li>
                @endif
            </ul>
            <div class="flex space-x-6 text-xl relative dropdown"> 

                <img src="{{ auth()->user()->profile ? auth()->user()->profile : url('images/icons/account.svg') }}" class="block w-20 h-12 text-white" referrerPolicy="no-referrer" >
                <div class="w-full">
                    <p class="text-md">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-gray-400">{{ auth()->user()->email }}</p>
                </div>
                <img src="{{ url('images/icons/arrow_down.svg')  }}" class="">
                <div class=" absolute border w-8/12 h-12 bg-white text-gray-400 flex justify-start space-x-4 px-4 py-1 rounded-md left-20 top-14 dropcontent">
                    <img src="{{ url('images/icons/logout.svg')  }}" class="w-5 h-10  inline"><a href="{{ route('logout') }}" class=" inline">Sign out</a>
                </div>
            </div>
        </div>
    </nav>
    {{ $slot }}



<script src="{{ url('js/video.js') }}"></script> 
<script src="{{ url('js/index.js') }}"></script> 
<script>
    document.addEventListener("livewire:navigated",function(){
    let dropdown = document.querySelector(".dropdown");
    let dropcontent = document.querySelector(".dropcontent");
    let state = false;
    dropcontent.style.display = "none";

    dropdown.addEventListener("click",function(){
        if(state){
            dropcontent.style.display = "none";
            state = false;
        }else{
            dropcontent.style.display = "block";
            state = true
        }
    })

    })
    
</script>
<livewire:scripts>
</body>
</html>