<x-layout>
    <div class="h-5 bg-green-200"></div>
    <x-search-bar></x-search-bar>
    <x-title>
        {{$category->name}}
    </x-title>
    <x-product-container>
        @forelse ($category->products as $product)
            <x-product-item :product="$product"></x-product-item>
        @empty
            <div class="h-40 flex flex-col justify-center items-center text-gray-700">
                No products
                <a href="/" class="p-2 text-xs p-2 rounded-lg bg-blue-900 text-white mt-2">
                    Return to Home
                </a>
            </div>
        @endforelse
    </x-product-container>
</x-layout>
