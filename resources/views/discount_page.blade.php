<x-layout>
    <x-title>
        {{$discount->description}}
    </x-title>
    <x-product-container>
        @foreach ($productDiscounts as $productDiscount)
          <x-product-item :product="$productDiscount->product"></x-product-item>
        @endforeach
    </x-product-container>
</x-layout>
