<section class="flex justify-center h-fit bg-authBodyColor">
<div class="md:w-4/12 w-10/12 bg-white drop-shadow-lg shadow-black border-2 md:-mt-24 -mt-14">
   <div class="py-6 space-y-4">
        <h1 class="text-3xl text-gray-700 text-center font-bold">Password reset</h1>
        <p class="px-16 text-center text-gray-700 text-md">Type your email below and we'll send you a link to 
            reset your password</p>
   </div>
   <div class="bg-gray-200 px-10 py-8">
        <form class="space-y-4">
            <input type="text" placeholder="Enter your email" class="block w-full border p-3 rounded-md shadow-md focus:outline-authBodyColor focus:outline">
            
            <button type="submit" class="w-full bg-btnColor p-3 rounded-md text-white">Reset password</button>
            <a href="{{ url()->previous() }}" class="block underline text-center text-gray-700" wire:navigate>Cancel</a>
        </form> 
   </div>
</div>
</section>
