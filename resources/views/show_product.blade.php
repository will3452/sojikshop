<x-layout>
    <div class="md:hidden fixed w-full h-12 bottom-0 left-0 right-0 bg-purple-900 flex items-center justify-around px-2">
        @if (!$product->carts()->where('user_id', auth()->id())->exists())
                @if ($product->quantity != 0)
                    <form
                    action="/add-to-cart/{{ $product->id }}"
                    method="POST"
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
                    px-4
                    bg-pink-600
                    rounded-xl
                    text-xs
                    "
                    >
                    ADD TO CART
                    </button>
                </form>
                @else
                <form
                    action="#pre-order"
                    method="POST"
                >
                    @csrf
                    <button
                    type="button"
                    class="
                    font-bold
                    text-white
                    flex
                    items-center
                    justify-between
                    py-2
                    px-4
                    bg-pink-600
                    rounded-xl
                    text-xs
                    uppercase
                    "
                    >
                    Pre-Order
                    </button>
                </form>
                @endif
            @else
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
                px-4
                bg-pink-600
                rounded-xl
                text-xs
                "
                >
                    CHECK MY CART
                </a>
            @endif

            @if (!$product->wishLists()->where('user_id', auth()->id())->exists())
                <form
                action="{{route('add.wishlist', ['product'=>$product->id])}}"
                method="POST"

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
                px-4
                bg-gray-900
                rounded-xl
                text-xs
                "
                >

                ADD TO WISHLIST
                </button>
            </form>
            @else
                <div>
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
                    px-4
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
    <div class="mt-4 md:flex md:w-2/3 md:mx-auto md:items-center">
        <div class="md:flex-none md:w-1/3 md:mr-4">
            <img src="/storage/{{ $product->image }}" alt="" class="w-full">
        </div>
        <div class="px-2">
            <h1 class="text-center font-bold text-lg text-purple-900 md:text-left">
                {{$product->name}}
            </h1>
            <div class="text-2xl text-center font-bold text-gray-900 md:text-left">
                <span class="text-lg">PHP</span> {{$product->price}}
            </div>
            <div class="flex justify-center md:2 md:my-2 md:justify-start">
                <span class="material-icons text-yellow-500">
                    star
                </span>
                <span class="material-icons text-yellow-500">
                    star
                </span>
                <span class="material-icons text-yellow-500">
                    star
                </span>
                <span class="material-icons text-yellow-500">
                    star
                </span>
                <span class="material-icons text-yellow-500">
                    star
                </span>
            </div>
            <div class="border-t-2 my-2 py-2 md:border-t-0">
                <div class="text-xs text-gray-500 font-bold ">
                    Description
                </div>
                <div class="text-xs p-2 text-gray-700 mb-10 md:mb-0">
                    {{$product->description}}
                </div>
                <div class="hidden md:block mt-4 md:flex">
                    @if (!$product->carts()->where('user_id', auth()->id())->exists())
                        @if ($product->quantity != 0)
                            <form
                                action="/add-to-cart/{{ $product->id }}"
                                method="POST"
                                class="
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
                                rounded
                                text-xs
                                mr-2
                                "
                                >
                                ADD TO CART
                                </button>
                            </form>
                            @else
                            <form
                                action="#"
                                class="
                                "
                            >
                                @csrf
                                <button
                                type="button"
                                class="
                                uppercase
                                font-bold
                                text-white
                                flex
                                items-center
                                justify-between
                                py-2
                                px-8
                                bg-pink-600
                                rounded
                                text-xs
                                mr-2
                                "
                                >
                                Pre-Order
                                </button>
                            </form>
                        @endif

                        @else
                            <div class="">
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
                                rounded
                                text-xs
                                mr-2
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
                            px-5
                            bg-gray-900
                            rounded
                            text-xs
                            mr-2
                            "
                            >

                            ADD TO WISHLIST
                            </button>
                        </form>
                        @else
                            <div class="">
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
                                rounded
                                text-xs
                                mr-2
                                "
                                >
                                    CHECK MY WISHLIST
                                </a>
                            </div>
                        @endif
                </div>
            </div>

        </div>

    </div>
</x-layout>
