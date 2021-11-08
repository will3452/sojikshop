<x-layout>
    <x-title>
        Pre-Order Now
    </x-title>
    <x-product-container>
        @foreach ($products as $product)
          <x-product-item :product="$product"></x-product-item>
        @endforeach
    </x-product-container>
</x-layout>
