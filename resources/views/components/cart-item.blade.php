@props(['cart'])
<li class="flex justify-between m-2 p-4 rouned-lg bg-white rounded-lg shadow-lg" id="cart{{ $cart->id }}">
    <div class="flex w-1/2 flex-none items-center">
        <img src="/storage/{{ $cart->product->image }}" alt=""
        class="w-12 rounded-lg object-fit">
        <div class="ml-2">
            <h4 class=" text-xs text-gray-800">
                {{ $cart->product->name }}
            </h4>
            @if ($cart->product->hasDiscount())
                <h4 class="text-xl font-bold text-gray-800">
                    P {{ number_format($cart->product->discounted_price, 2) }}
                </h4>
            @else
                <h4 class="text-xl font-bold text-gray-800">
                    P {{ number_format($cart->product->normal_price, 2) }}
                </h4>
            @endif
        </div>
    </div>
    <div class="flex items-end flex-col justify-between">
        <div class="flex justify-end">
            <form action="/increase-quantity/{{ $cart->id }}" method="POST">
                @csrf
                <button
                class="
                bg-white
                p-2
                text-gray-900
                py-0
                rounded-lg
                ">+</button>
            </form>
            <input type="text"
            class="
            w-1/6
            text-center
            text-xl
            "
            value="{{ $cart->quantity }}"
            readonly>
            <form action="/decrease-quantity/{{ $cart->id }}" method="POST">
                @csrf
                <button
                class="
                bg-white
                p-2
                text-gray-900
                py-0
                rounded-lg
                ">-</button>
            </form>
        </div>
        <form action="/remove-to-cart/{{ $cart->id }}" method="POST" x-data="{isRemove:false}">
            @csrf
            @method('DELETE')
            <button x-show="!isRemove" x-on:click="isRemove = true" class="bg-white text-red-500 text-xs text-blue-900 p-1 px-2 rounded border-2 border-red-500">
                REMOVE
            </button>
            <button x-show="isRemove" class="flex items-center bg-white text-red-500 text-xs text-blue-900 p-1 px-2 rounded border-2 border-red-500">
                <span class="material-icons animate-spin" style="font-size:16px;">
                    autorenew
                </span>
                REMOVE
            </button>
        </form>
    </div>
</li>
