<x-layout>
    <div class="md:flex md:bg-red-100 md:w-2/3 md:mx-auto md:mt-20">
        <div>
            <img
            class="w-full md:w-1/2 md:mx-auto"
            src="/storage/{{ $product->image }}"
            alt="">
            <div class="text-center">
                <h1 class="font-black text-3xl text-pink-700 mb-4">
                    P {{ number_format($product->price, 2) }}
                </h1>
                <h2 class=" font-bold px-8 text-blue-900">
                    {{ $product->name }}
                </h2>
            </div>
        </div>

        <div>
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
                    text-blue-900
                    border-b-2
                    border-blue-900
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
                    text-blue-900
                    border-b-2
                    border-blue-900
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
                text-blue-900
                flex
                items-center
                justify-between
                py-2
                px-8
                bg-green-200 text-blue-900
                rounded-xl
                animate-pulse
                text-xs
                "
                >
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
                    text-blue-900
                    flex
                    items-center
                    justify-between
                    py-2
                    px-8
                    bg-blue-600
                    rounded-xl
                    text-xs
                    "
                    >
                        CHECK MY CART
                    </a>
                </div>
            @endif

            @if (!$product->wishLists()->where('user_id', auth()->id())->exists())
                <form
                action="{{route('add.wishlist', ['product'=>$product->id])}}"
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
                text-blue-900
                flex
                items-center
                justify-between
                py-2
                px-5
                bg-gray-900
                rounded-xl
                animate-pulse
                text-xs
                "
                >

                ADD TO WISHLIST
                </button>
            </form>
            @else
                <div class="flex justify-center mt-4">
                    <a
                    href="{{route('my.wishlist')}}"
                    type="submit"
                    class="
                    font-bold
                    text-black
                    flex
                    items-center
                    justify-between
                    py-2
                    px-5
                    bg-gray-300
                    rounded-xl
                    text-xs
                    "
                    >
                        CHECK MY WISHLIST
                    </a>
                </div>
            @endif
        </div>
    </div>

</x-layout>
