@props(['product'])
<div class="col-md-3 mt-4">
    <div class="item-card">
        <img src="/storage/{{ $product->image }}" alt="" class="img-fluid">
        <div class="item-card-price">
            P {{ $product->price }}
        </div>
    </div>
    <h6 class="text-center">
        {{ $product->name }}
    </h6>
</div>