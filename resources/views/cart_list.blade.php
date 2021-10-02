<x-layout>
    <div class="mx-auto md:w-2/4 h-auto">
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
        @if (count($carts))
            <div class="flex justify-between">
                <a href="/" class="rounded-lg px-4 m-3 py-2 bg-purple-700 text-white text-xs">
                    Continue Shopping
                </a>
                <a class="cursor-pointer rounded-lg px-4 py-2 m-3 bg-pink-700 text-white text-xs" href="{{route('checkout')}}">
                    Proceed to Checkout
                </a>
            </div>
        @endif
    </div>

</x-layout>
