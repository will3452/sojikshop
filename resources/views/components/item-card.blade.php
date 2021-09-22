@props(['product'])
<div class="col-md-3 mt-4 col-sm-6">
    <div class="item-card">
        <div style="
            width:100%;
            height:100%;
            background:url('/storage/{{ $product->image }}');
            background-size:contain;
            background-position:center;
            background-repeat:no-repeat;
            ">

        </div>
        <div class="item-card-price">
            P {{ $product->price }}
        </div>
    </div>
    <h6 class="text-center">
        {{ $product->name }}
    </h6>
</div>