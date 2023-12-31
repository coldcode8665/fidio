
<section class="flex justify-center max-h-screen bg-authBodyColor">
<div class="md:w-4/12 w-10/12 bg-white drop-shadow-lg shadow-black border-2 md:-mt-24 -mt-14">
   <div class="py-8 space-y-4">
        <h1 class="text-3xl text-gray-700 text-center font-bold">Login in</h1>
        <p class="text-center text-gray-700">Don't have an account?<a href="{{ route('auth.signup') }}" class="underline text-btnColor" wire:navigate> sign in</a></p>
   </div>
   <div class="bg-gray-200 px-10 py-8">
        <p class="text-btnColor my-2">{{ session('msg') }}</p>
        <form class="space-y-4" wire:submit="store">
            <input type="text" placeholder="Enter your email" class="block w-full border p-3 rounded-md shadow-md focus:outline-authBodyColor focus:outline @error('email') border-red-600 @enderror" wire:model.live="email">
                @error('email')
                    <label class="text-btnColor"> {{ $message }} </label>
                @enderror
            <input type="password" placeholder="Password" class="block w-full border p-3 rounded-md shadow-md focus:outline-authBodyColor focus:outline @error('password') border-red-600 @enderror" wire:model="password">
                @error('password')
                    <label class="text-btnColor"> {{ $message }} </label>
                @enderror
            <button type="submit" class="w-full bg-btnColor p-3 rounded-md text-white">Log in</button>
            <a href="{{ route('auth.passwordreset') }}" class="block text-center underline text-gray-700" wire:navigate>Forgot password?</a>
        </form> 
        <!-- md:px-32 px-16  -->
        <a href="{{ route('auth.google') }}" class="max-w-full bg-white shadow-md p-3 rounded-md flex flex-row justify-center my-4">
            <img src="{{ url('images/icons/google.svg')}}" class="inline mx-2"><span class="text-navColor">Log in with Google</span>
        </a>
        <p class="text-xs text-center text-gray-500">By continuing,you agree to our <span class="underline cursor-pointer">Terms of Service</span> and <span class="underline cursor-pointer">Privacy Policy</span>
   </div>
</div>
</section>
