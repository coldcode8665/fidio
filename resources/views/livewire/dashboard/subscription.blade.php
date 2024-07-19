<div class="w-8/12 mx-auto mt-16 ">
    @if(count($video) > 0)
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold text-authBodyColor">Subscriptions</h1>
            <a href=" {{ route('dashboard.subscription.select') }} " class="bg-btnColor px-6 py-4 text-white rounded-md">Add videos</a>
        </div>
        <section class="mt-20 space-y-8">
           <p class="text-5xl text-gray-500">2.5K</p>
           <div>
                <small class="text-2xl text-gray-600 font-bold">Subscribers</small>
                <a href="" class="text-btnColor underline block">view subscribers</a>
           </div>
           <p class="text-5xl text-gray-500">$13,000</p>
           <small class="text-2xl text-gray-600 font-bold">Earnings</small>
           <p class="text-5xl text-gray-500">$10.99/mo</p>
           <small class="text-2xl text-gray-600 font-bold">Price</small>
        </section>
    @else
        <h1 class="text-3xl font-bold text-authBodyColor">Subscriptions</h1>
        <section class="w-8/12 mx-auto mt-20 text-center space-y-4">
            <img src="{{ url('images/icons/icon_d1.svg') }}" class="mx-auto">
            <p class="text-2xl font-bold text-authBodyColor">No subscriptions yet</p>
            <p class="-mt-4 text-authBodyColor">With subscriptions, you can get paid for your content.</p>
            <a href="{{ route('dashboard.subscription.select') }}" class="bg-btnColor px-6 py-4 w-4/12 block mx-auto text-center text-white rounded-md shadow-md">Set up Subscription</a>
            <p class="text-gray-400">Subscriptions only work for videos distributed to your fidio website</p>
            <a href="" class="text-btnColor underline">Learn more</a>
        </section>
    @endif
</div>

