<x-layout>
    <x-title>
        Pre-Order Now
    </x-title>
    <x-product-container>
        @foreach (\App\Models\Product::where('quantity', 0)->get() as $product)
          <x-product-item :product="$product"></x-product-item>
        @endforeach
    </x-product-container>
</x-layout>
