@props(['product'])
<a
    x-data=""
    href="{{ route('products.show', $product) }}"

    class="
        block
        h-52
        m-2
        w-2/5
        md:h-80
        md:w-1/6
        rounded-lg
        shadow-2xl
        flex-none
        relative
        overflow-hidden
        "
        style="background:url('/storage/{{ $product->image }}');
        background-size:contain;background-repeat:no-repeat;
        background-position:center;
        "
        >
        @if ($product->quantity <= 0)
            <div class="absolute bg-gray-500 transform rotate-45 w-40 text-center text-xs p-1 font-bold text-white uppercase top-8 -right-8">
                Out-of-stock
            </div>
        @endif
            <div class="
            p-2 text-center md:text-left font-bold text-pink-600 ">
                P {{ number_format($product->price, 2) }}
            </div>
        <div class="
        bg-gradient-to-r from-purple-400 to-pink-500
        px-2 absolute bottom-0 w-full text-center text-xs font-bold uppercase py-2 text-white
        ">
            {{ \Str::limit($product->name, 25) }}
        </div>
</a>
