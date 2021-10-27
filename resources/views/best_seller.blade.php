<x-layout>
    <x-title>
        Best Seller
    </x-title>
    <x-product-container>
        @foreach ($products as $product)
          <x-product-item :product="$product"></x-product-item>
        @endforeach
    </x-product-container>
</x-layout>
