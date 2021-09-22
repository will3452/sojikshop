@php
    $banners = \App\Models\Banner::get();
@endphp
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($banners as $key=>$banner)
            @if ($loop->first)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="active"></li>
            @else 
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"></li>
            @endif
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($banners as $key=>$banner)
            @if ($loop->first)
               <div class="carousel-item active">
                    <img src="/storage/{{ $banner->image }}" class="d-block w-100" alt="...">
                </div>
            @else 
                <div class="carousel-item">
                    <img src="/storage/{{ $banner->image }}" class="d-block w-100" alt="...">
                </div>
            @endif
        @endforeach
        
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>