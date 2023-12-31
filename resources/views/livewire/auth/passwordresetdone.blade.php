<section class="flex justify-center h-fit bg-authBodyColor">
<div class="md:w-4/12 w-10/12 bg-white drop-shadow-lg shadow-black border-2 md:-mt-24 -mt-14">
   <div class="py-6 space-y-4">
        <h1 class="text-3xl text-gray-700 text-center font-bold">Password reset</h1>
        <p class="px-16 text-center text-gray-700 text-md">Email sent</p>
   </div>
   <div class="space-y-4 bg-gray-200 py-6">
        <p class="text-center text-gray-700 text-md border">Check your inbox for the password reset link</p>
        <img src="{{ url('images/icons/check.svg') }}" class="border mx-auto">
        <a href="{{ route('auth.login') }}" class="block text-center underline text-gray-700" wire:navigate>Back to login</a>
   </div>
</div>
</section>
