<div class="w-10/12 mx-auto">
    <div class="mx-auto w-full" style="background-image: url({{ asset('storage/'.$data->hero_path) }}); height:100vh; background-repeat:no-repeat; background-size:100% 140%"></div> 
        <div class="px-12 block  -mt-60 z-10  space-y-8 w-full mx-auto" style="background-image: linear-gradient(transparent,black 15%); ">
                <p class="text-7xl text-white font-bold text-left">{{ $data->title }}</p>
                <p class="text-white w-6/12">{{ $data->bio }}</p>

                    @if($data->bio)

                    <!-- Login -->
                    @if(!auth('user')->user())
                        <div class="fixed w-full h-screen bg-transparent  -top-8 left-0 flex items-center authContainer" wire:ignore>
                            <div class="bg-gray-500 w-3/12 p-6 rounded-lg mx-auto" id="login">
                                <div class="flex mb-4">
                                    <div class="w-full">
                                        <img src="{{ asset('images/icons/lock.svg') }}" class="bg-white p-4 rounded-full mx-auto" height="80" width="80" class="mx-auto">
                                    </div>
                                    <p class="font-bold text-2xl text-white cursor-pointer close">X</p>
                                </div>
                                <p class="text-4xl text-white font-bold my-3">Sign in</p>
                                <p class="text-white">Sign in to access {{ $data->title."'s" }} content</p>
                                <div class="space-y-4 mt-4">
                                    <small id="LoginError" class="text-red-400 mb-2"></small>
                                    <form class="formlogin">
                                        <div>
                                            <label class="text-white my-2 block">Email</label>
                                            <small id="emailLoginError" class="text-red-400 mb-2"></small>
                                            <input type="email" class="w-full rounded-md p-3  focus:outline-0" id="email">
                                        </div>
                                        <div>
                                            <label class="text-white my-2 block">Password</label>
                                            <small id="passwordLoginError" class="text-red-400 mb-2"></small>
                                            <input type="password" class="w-full rounded-md p-3 focus:outline-0" id="password">
                                        </div>
                                        <small class="text-white my-2 block">Don't have an account? <a class="underline link cursor-pointer" value="r">sign up</a></small>
                                        <input type="submit" value="login" class="w-full p-3 bg-black rounded-md text-white">
                                    </form>
                                </div>
                            </div>

                            <div class="bg-gray-500 w-3/12 p-6 rounded-lg mx-auto" id="register">
                                <div class="flex mb-4">
                                    <div class="w-full">
                                        <img src="{{ asset('images/icons/lock.svg') }}" class="bg-white p-4 rounded-full mx-auto" height="80" width="80" class="mx-auto">
                                    </div>
                                    <p class="font-bold text-2xl text-white cursor-pointer close">X</p>
                                </div>
                                <p class="text-4xl text-white font-bold my-3">Sign up</p>
                                <p class="text-white">Sign up to access {{ $data->title."'s" }} content</p>
                                <div class="space-y-4 mt-4">
                                    <form class="register">
                                        <div>
                                            <label class="text-white my-2 block">Username</label>
                                                <small id="usernameError" class="text-red-400 mb-2"></small>
                                            <input type="text" class="w-full rounded-md p-3  focus:outline-0" id="username">
                                        </div>
                                        <div>
                                            <label class="text-white my-2 block">Email</label>
                                            <small id="emailError" class="text-red-400 mb-2"></small>
                                            <input type="email" class="w-full rounded-md p-3  focus:outline-0" id="regemail">
                                        </div>
                                        <div>
                                            <label class="text-white my-2 block">Password</label>
                                            <small id="passwordError" class="text-red-400 mb-2"></small>
                                            <input type="password" class="w-full rounded-md p-3 focus:outline-0" id="regpassword">
                                        </div>
                                        <div>
                                            <label class="text-white my-2 block">Retype Password</label>
                                            <small id="confirmPasswordError" class="text-red-400 mb-2"></small>
                                            <input type="password" class="w-full rounded-md p-3 focus:outline-0" id="confirm_password">
                                        </div>
                                        <small class="text-white">Already have an account? <a class="underline link cursor-pointer" value="l">sign in</a></small>
                                        <input type="submit" value="Sign up" class="w-full p-3 bg-black rounded-md text-white"  wire:loading.attr="disabled">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                        <div class="flex space-x-4 w-6/12">
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
                    @endif
                    
                @if($videos->count() > 0)
                    <div class="py-4">
                        <a href="{{ route('storefront.view',['video' => $videos[0]->id,'website' => $data->domain]) }}" class="inline" >
                            {{-- <img src="{{ asset('storage/'.$videos[0]->thumbnail) }}" class="w-full" height="100"> --}}
                            <div class="flex justify-center items-center" style="height:50vh; background-image: url({{ asset('storage/'.$videos[0]->thumbnail) }}); background-repeat:no-repeat; background-size:cover;background-position:100% 10%;" class="w-full">
                                <img src="{{ asset('images/icons/Icon.png') }}">
                            </div>
                        </a>
                        <div class="flex justify-between text-white font-bold py-3">
                            <p class="text-3xl w-10/12">{{ $videos[0]->title }}</p>
                            @if($videos[0]->price != null)
                                <p class="text-3xl">{{ '$'.$videos[0]->price }}</p>
                            @else
                                <p class="text-3xl">Free</p>
                            @endif
                        </div>
                       
                        <p class="text-white">{{ $videos[0]->created_at->diffForHumans() }} <small class="mx-2">-</small> {{ $videos[0]->views()->count()." ".Str::plural('View',$videos[0]->views()->count())}}</p>
                    </div>
                @else
                    <p class="text-center text-white my-10">No videos</p>
                @endif
        </div>

        @if($videos->count() > 0)
            <div class="flex justify-between flex-wrap w-full mx-auto">
                @foreach($videos as $video)
                
                    <div class="w-6/12 px-4 mb-4">
                        <a href="{{ route('storefront.view',['video' => $video->id,'website' => $data->domain]) }}" class="inline" >
                        <div class="flex justify-center items-center" style="height:50vh; background-image: url({{ asset('storage/'.$video->thumbnail) }}); background-repeat:no-repeat; background-size:cover;" class="w-full">
                            <img src="{{ asset('images/icons/Icon.png') }}">
                        </div>
                        </a>
                        <div class="flex justify-between text-white font-bold py-3">
                            <p class="text-3xl w-10/12">{{ $video->title }}</p>
                            @if($video->price != null)
                                <p class="text-3xl">{{ '$'.$video->price }}</p>
                            @else
                                <p class="text-3xl">Free</p>
                            @endif
                        </div>
                       
                        <p class="text-white">{{ $video->created_at->diffForHumans() }} <small class="mx-2">-</small> {{ $video->views()->count()." ".Str::plural('View',$video->views()->count()) }}</p>
                    </div>
                
                @endforeach
            </div>
        @else
            
        @endif
    </div>

    <script>
// document.addEventListener('livewire:init',function(){

        let login = document.querySelector("#login")
        let formlogin = document.querySelector(".formlogin")
        let formRegister = document.querySelector(".register")
        let auth = document.querySelector(".authContainer")
        let register = document.querySelector("#register")
        let link = document.querySelectorAll(".link");
        let close = document.querySelectorAll(".close");
        let state = 0
        register.classList.add("hidden");

        link.forEach((val) => {
            val.addEventListener('click',function(){
            if(val.getAttribute('value') == 'r'){
                register.classList.remove("hidden");
                login.classList.add("hidden");
            }else if(val.getAttribute('value') == 'l'){
                register.classList.add("hidden");
                login.classList.remove("hidden");
            }
        })
    })

    close.forEach((val) => {
        val.addEventListener('click',function(){
            auth.remove();
        })
    })

    formRegister.addEventListener('submit',function(e) {
        e.preventDefault()
            // Reset error messages
            document.getElementById('usernameError').innerText = '';
            document.getElementById('emailError').innerText = '';
            document.getElementById('passwordError').innerText = '';
            document.getElementById('confirmPasswordError').innerText = '';

            // Get input values
            var username = document.getElementById('username').value.trim();
            var email = document.getElementById('regemail').value.trim();
            var password = document.getElementById('regpassword').value.trim();
            var confirm_password = document.getElementById('confirm_password').value.trim();

            // Validate username
            if (username === '') {
                document.getElementById('usernameError').innerText = 'Username is required';
            }

            // Validate email
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '') {
                document.getElementById('emailError').innerText = 'Email is required';
            } else if (!emailRegex.test(email)) {
                document.getElementById('emailError').innerText = 'Invalid email format';
            }

            // Validate password
            if (password === '') {
                document.getElementById('passwordError').innerText = 'Password is required';
            }else if(password.length < 5){
                document.getElementById('passwordError').innerText = 'Password length too short';
            }

            // Validate confirm password
            if (confirm_password === '') {
                document.getElementById('confirmPasswordError').innerText = 'Confirm Password is required';
            } else if (confirm_password !== password) {
                document.getElementById('confirmPasswordError').innerText = 'Passwords do not match';
            }

            if(username && email && password == confirm_password){
                @this.dispatch("save",{
                username,email,password
                });

                @this.on('reg',function(e){
                    console.log(e)
                })
                @this.on('done',function(e){
                    window.location.reload()
                })
                
            }

            
        })


        formlogin.addEventListener("submit",function(e){
            e.preventDefault();
            function validateLogin(){
                let email = document.getElementById('email').value.trim();
                let password = document.getElementById('password').value.trim();

                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email === '') {
                    document.getElementById('emailLoginError').innerText = 'Email is required';
                } else if (!emailRegex.test(email)) {
                    document.getElementById('emailError').innerText = 'Invalid email format';
                }

                // Validate password
                if (password === '') {
                    document.getElementById('passwordLoginError').innerText = 'Password is required';
                }

                if(email && password){
                    @this.dispatch('login',{email,password});
                }

                @this.on('loginError',(e) => {
                    document.getElementById('LoginError').innerText =  e[0].message;
                })
                @this.on('loginSuccess',(e) => {
                    window.location.reload()
                })
            }
            validateLogin()
        })


    </script>

</div>
