<x-layout>
    <div class="mx-auto md:w-2/4 h-screen">
        <x-title>
            YOUR CART
        </x-title>
        <ul >
            @forelse ($carts as $item)
                <x-cart-item :cart="$item"></x-cart-item>
            @empty
            <div class="w-full h-40 flex items-center justify-center">
                <div class="text-center">
                    <span class="text-gray-700 font-bold">
                        YOUR CART IS EMPTY
                    </span>
                    <div>
                        <a href="/" class="text-white rounded-lg animate-bounce block px-3 py-2 bg-purple-900 mt-4">
                            GO SHOP NOW!
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </ul>
        @if ($totalCost != 0)
            <div class="p-3 bg-pink-300 mx-2 rounded-lg flex items-center">
                <h1 class="flex-none text-center font-bold text-2xl text-pink-900">
                    TOTAL COST : P {{ number_format($totalCost,2) }}
                </h1>
            </div>
            <div class="flex justify-between">
                <a href="/" class="rounded-lg px-4 m-3 py-2 bg-purple-700 text-white text-xs">
                    SHOP MORE
                </a>
                <a href="#" class="rounded-lg px-4 py-2 m-3 bg-green-500 text-white text-xs">
                    CHECKOUT WITH PAYPAL
                </a>
            </div>
        @endif
    </div>

</x-layout>
