<x-layout>
    @auth
          @if (auth()->user()->addresses()->count() == 0 && url()->current() !== route('profile'))
          <script>
                alert('Please setup your default address first.');
                window.location.href = '/profile/';
                //
            </script>
          @endif
      @endauth
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

  <div class="bg-blue-800 text-sm font-bold text-center p-4 mt-4">
      @foreach (\App\Models\Page::get() as $page)
        <a href="/page/{{$page->id}}" class="mx-2 text-green-900" >{{$page->title}}</a>
      @endforeach
  </div>
  {{-- {!!nova_get_setting('facebook_scripts')!!} --}}
</x-layout>
