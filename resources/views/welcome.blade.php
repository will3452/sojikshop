<x-layout>
	<x-search-bar></x-search-bar>
	<x-banner></x-banner>
	<x-y-space></x-y-space>
	
	<x-y-space></x-y-space>
	<x-container>
		<x-title>
			BROWSE OUR LATEST ITEMS
		</x-title>
		<x-y-space></x-y-space>
		<div class="row">
			@foreach (\App\Models\Product::latest()->limit(8)->get() as $product)
				<x-item-card :product="$product"></x-item-card>
			@endforeach
		</div>
	</x-container>
</x-layout>