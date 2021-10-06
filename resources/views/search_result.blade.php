<x-layout>
    <div class="h-5 bg-gradient-to-r from-pink-500 to-purple-900"></div>
    <x-search-bar></x-search-bar>
    <h2 class="text-center text-gray-600 text-base mt-2">
        Search Keyword : <span class="italic font-bold">"{{request()->keyword}}"</span>
    </h2>
    <x-product-container>
        @forelse ($products as $product)
            <x-product-item :product="$product"></x-product-item>
        @empty
            <div class="h-40 flex flex-col justify-center items-center text-gray-700">
                No products
                <a href="/" class="p-2 text-xs p-2 rounded-lg bg-purple-900 text-white mt-2">
                    Return to Home
                </a>
            </div>
        @endforelse
    </x-product-container>
</x-layout>
