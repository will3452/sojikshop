@props(['cart'])
<li class="flex justify-between m-2 p-4 rouned-lg bg-blue-200 rounded-lg" id="cart{{ $cart->id }}">
    <div class="flex w-1/2 flex-none items-center">
        <img src="/storage/{{ $cart->product->image }}" alt=""
        class="w-12 rounded-lg object-fit">
        <div class="ml-2">
            <h4 class=" text-xs text-blue-900">
                {{ $cart->product->name }}
            </h4>
            <h4 class="text-xl font-bold text-blue-900">
                P {{ number_format($cart->product->price, 2) }}
            </h4>
        </div>
    </div>
    <div class="flex items-center">
        <div class="flex">
            <form action="/increase-quantity/{{ $cart->id }}" method="POST">
                @csrf 
                <button
                class="
                bg-purple-700
                p-2 font-bold 
                text-white 
                py-0
                rounded-lg
                ">+</button>
            </form>
        <input type="text"
        class="
        w-1/6
        text-center
        text-xl
        bg-blue-200
        "
        value="{{ $cart->quantity }}"
        readonly>
        <form action="/decrease-quantity/{{ $cart->id }}" method="POST">
            @csrf
            <button
            class="
            bg-purple-700
            p-2 font-bold 
            text-white 
            py-0
            rounded-lg
            ">-</button>
        </form>
        </div>
        <form action="/remove-to-cart/{{ $cart->id }}" method="POST">
            @csrf 
            @method('DELETE')
            <button class="bg-red-500 text-white p-1 px-2 rounded-xl">
                REMOVE
            </button>
        </form>
    </div>
</li>