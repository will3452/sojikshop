<x-layout>
  <x-banner></x-banner>
  <x-search-bar></x-search-bar>
  <x-title>new arrival</x-title>
  <x-product-container>
    @foreach (\App\Models\Product::latest()->limit(10)->get() as $product)
      <x-product-item :product="$product"></x-product-item>
    @endforeach
  </x-product-container>
  <x-hero></x-hero>
  <x-title>
    OTHER PRODUCTS
  </x-title>
  <x-product-container-slider>
    @foreach (\App\Models\Product::inRandomOrder()->limit(12)->get() as $product)
      <x-product-item :product="$product"></x-product-item>
    @endforeach
  </x-product-container-slider>
</x-layout>
