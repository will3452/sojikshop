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
        @if ($product->is_pre_order)
            <div class="absolute bg-yellow-500 transform rotate-45 w-40 text-center text-xs p-1 font-bold text-blue-900 uppercase top-8 -right-8">
                Pre-Order
            </div>
        @elseif ($product->quantity <= 0)
            <div class="absolute bg-gray-500 transform rotate-45 w-40 text-center text-xs p-1 font-bold text-blue-900 uppercase top-8 -right-8">
                Out-of-stock
            </div>
        @elseif($product->discounts()->count())
            <div class="absolute bg-green-500 transform rotate-45 w-40 text-center text-xs p-1 font-bold text-blue-900 uppercase top-8 -right-8">
                {{$product->discounts()->first()->discount->discount}} % Off
            </div>
        @endif
            <div class="
            p-2 text-center md:text-left font-bold text-pink-600 ">
                P {{ number_format($product->normal_price, 2) }}
            </div>
        <div class="
        bg-green-200
        px-2 absolute bottom-0 w-full text-center text-xs font-bold uppercase py-2 text-blue-900
        ">
            {{ \Str::limit($product->name, 25) }}
        </div>
</a>
