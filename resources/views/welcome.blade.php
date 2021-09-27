<x-layout>
  <x-navbar></x-navbar>
  <x-banner></x-banner>
  <x-search-bar></x-search-bar>
  <x-title>Latest Products</x-title>
  <x-product-container>
    @foreach (\App\Models\Product::latest()->limit(4)->get() as $product)
      <x-product-item :product="$product"></x-product-item>
    @endforeach
  </x-product-container>
  <x-hero></x-hero>

  <x-title>
    Products
  </x-title>
  <x-product-container-slider>
    @foreach (\App\Models\Product::inRandomOrder()->limit(12)->get() as $product)
      <x-product-item :product="$product"></x-product-item>
    @endforeach
  </x-product-container-slider>
  <x-footer></x-footer>
</x-layout>