<x-layout>
  <x-banner></x-banner>
  <x-search-bar></x-search-bar>
  <x-title>new arrival</x-title>
  <x-product-container>
    @foreach (\App\Models\Product::where('quantity', '!=', 0)->latest()->limit(10)->get() as $product)
      <x-product-item :product="$product"></x-product-item>
    @endforeach
  </x-product-container>
  <x-hero></x-hero>
  <x-title>
    OTHER PRODUCTS
  </x-title>
  <x-product-container-slider>
    @foreach (\App\Models\Product::where('quantity', '!=', 0)->inRandomOrder()->limit(12)->get() as $product)
      <x-product-item :product="$product"></x-product-item>
    @endforeach
  </x-product-container-slider>

  <div class="bg-green-200 text-sm font-bold text-center p-4 mt-4">
      <a href="/page?page=about_us" class="mx-2 text-green-900" >About us</a>|
      <a href="/page?page=contacts" class="mx-2 text-green-900" >Contact Us</a>|
      <a href="/terms" class="mx-2 text-green-900" >Terms and Conditions</a>|
      <a href="/data" class="mx-2 text-green-900" >Data Privacy</a>
  </div>
  {!!nova_get_setting('facebook_scripts')!!}
</x-layout>
