<x-layout>
    <x-title>
        WishList ({{count($wishlists)}})
    </x-title>
    <ul class="md:w-1/2 mx-auto">
        @forelse ($wishlists as $item)
            <li class="bg-purple-100 text-purple-900 mx-2 p-2 flex justify-between items-center rounded-lg my-2">
                <div class="flex-none w-1/2 text-xs ">
                    {{$item->product->name}}
                </div>
                <div>
                    <a href="/products/{{$item->product->id}}"
                        class="
                            bg-purple-900
                            text-white
                            p-2
                            px-4
                            rounded-lg
                            text-xs
                        ">
                        Show
                    </a>
                </div>
            </li>
        @empty
            <li class="bg-gray-100 md:w-1/2 mx-auto p-4 rounded-lg py-8 text-center text-2xl text-gray-700 uppercase">
                Empty List 😢
            </li>
        @endforelse
    </ul>
</x-layout>
