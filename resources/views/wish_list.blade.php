<x-layout>
    <x-title>
        WishList <small class="text-xs">({{count($wishlists)}})</small>
    </x-title>
    <ul class="md:w-2/3 mx-auto px-2">
        @forelse ($wishlists as $item)
            <li class="bg-blue-100 text-blue-900 mx-2 p-2 flex justify-between items-center rounded-lg my-2">
                <div class="flex-none w-1/2 text-xs ">
                    {{$item->product->name}}
                </div>
                <div>
                    <a href="/remove-wishlist/{{$item->id}}"
                        class="
                            bg-red-500
                            text-blue-900
                            p-1
                            px-2
                            rounded-lg
                            text-xs
                            mx-1
                        ">
                        REMOVE
                    </a>
                    <a href="/products/{{$item->product->id}}"
                        class="
                            bg-blue-900
                            text-blue-900
                            p-1
                            px-2
                            rounded-lg
                            text-xs
                            mx-1
                        ">
                        SHOW
                    </a>
                </div>
            </li>
        @empty
            <li class="bg-gray-100 md:w-1/2 mx-auto p-4 rounded-lg py-8 text-center text-2xl text-gray-700 uppercase">
                <span class="material-icons text-gray-500">
                    filter_none
                </span>
                <div>
                    EMPTY
                </div>
            </li>
        @endforelse
    </ul>
</x-layout>
