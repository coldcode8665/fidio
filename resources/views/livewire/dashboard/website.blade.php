<div class="w-8/12 mx-auto">
    <h1 class="text-3xl text-authBodyColor font-bold my-10">Website details</h1>
        @if(session('msg'))
            <p class="text-green-600">{{ session('msg') }}</p>
        @endif
    <div class="space-y-10">
        <div>
          
            <label class="block text-authBodyColor my-2 text-lg">webiste title*</label>

            @error('title')
                <p class="text-btnColor">{{ $message }}</p>
            @enderror
            <input wire:model.live="title" class="block @error('title') border-red-500 @enderror w-full border p-3 rounded-md shadow-sm focus:outline outline-authBodyColor" type="text" placeholder="Give your website a title">
            <small class="my-2 text-authBodyColor">this is the bold text that appears at the top of your website</small>
        </div>
        <div>
            
            <label class="block  text-authBodyColor my-2 text-lg">Your bio*</label>
            @error('bio')
                <p class="text-btnColor">{{ $message }}</p>
            @enderror
            <textarea class="block @error('description') border-red-500 @enderror w-full resize-none border h-28 rounded-md focus:outline outline-authBodyColor p-3" placeholder="tell your audience about you" wire:model.live="bio"></textarea>
        </div>
    </div>

    <!-- #D9D9D9 -->

    <h1 class="text-3xl text-authBodyColor font-bold my-10">Website hero image</h1>

    <div class="border flex p-2 justify-between my-4">
        <img src="{{ $image ? $image->temporaryUrl() : url('images/icons/thumbnail.png') }}" class="block w-4/12 h-full">

        <div class="w-8/12">
            <div class="w-full h-full flex flex-col justify-center items-center">
            @error('image')
                <p class="text-btnColor">{{ $message }}</p>
            @enderror
                    <p class="py-2 text-gray-500">Upload a hero image for your website</p>
                    <button class="border-4 p-2 rounded-lg relative"> <input type="file" wire:model="image" class=" absolute opacity-0">Upload image</button>
            </div>
        </div>
    </div>
    @if(session('msg'))
        <p class="text-green-600">{{ session('msg') }}</p>
    @endif
    <hr class="w-full my-12">
    <div class="w-full flex justify-end my-10">
        <button class="bg-btnColor text-white px-4 py-2 rounded-md" wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled">
            save
        </button>
    </div>
</div>
