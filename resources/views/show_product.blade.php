<x-layout>
    <div>
        <img
        class="w-full md:w-1/5 md:mx-auto"
        src="/storage/{{ $product->image }}"
        alt="">
        <div class="text-center">
            <h1 class="font-black text-3xl text-purple-700 mb-2">
                P {{ number_format($product->price, 2) }}
            </h1>
            <h2 class=" font-bold px-8 text-purple-900">
                {{ $product->name }}
            </h2>
        </div>
    </div>

    <div x-data="{showMore:false}">
        <div x-show="showMore"
        class="
        text-sm
        text-center
        text-gray-700 pt-4
        md:w-2/3
        md:mx-auto
        px-4">
            {{ $product->description }}
        </div>
        <div
        class="flex justify-center mt-4" x-show="!showMore"
        >
            <button class="
            text-sm
            p-1
            font-thin
            text-sm
            text-purple-900
            border-b-2
            border-purple-900
            shadow-xl
            "
            @click="showMore = true"
            >
                Show More
            </button>
        </div>
        <div
        class="flex justify-center mt-4" x-show="showMore"
        >
            <button class="
            text-sm
            p-1
            font-thin
            text-sm
            text-purple-900
            border-b-2
            border-purple-900
            shadow-xl
            "
            @click="showMore = false"
            >
                Show Less
            </button>
        </div>
    </div>

    @if (!$product->carts()->where('user_id', auth()->id())->exists())
        <form
        action="/add-to-cart/{{ $product->id }}"
        method="POST"
        class="
        flex
        justify-center
        my-4
        "
    >
        @csrf 
        <button
        type="submit"
        class="
        font-bold
        text-white
        flex
        items-center
        justify-between
        py-2
        px-8
        bg-pink-600
        rounded-xl
        animate-pulse
        "
        >
        <span class="material-icons">
            add
        </span>
        ADD TO CART
        </button>
    </form>
    @else 
        <div class="flex justify-center mt-4">
            <a
            href="/my-cart"
            type="submit"
            class="
            font-bold
            text-white
            flex
            items-center
            justify-between
            py-2
            px-8
            bg-blue-600
            rounded-xl
            "
            >
            <span class="material-icons">
                view_list
                </span>
                CHECK MY CART
            </a>
        </div>
    @endif
    
</x-layout>