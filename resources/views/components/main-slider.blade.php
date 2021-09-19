<!-- Slider Area -->
@php
    $banner = \App\Models\Banner::inRandomOrder()->first();
@endphp
<section class="hero-slider owl-carousel">
    <!-- Single Slider -->
    <div class="single-slider item" style="background: url('/storage/{{ $banner->image }}')">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-9 offset-lg-3 col-12">
                </div>
            </div>
        </div>
    </div>
    <div class="single-slider item" style="background: url('/storage/{{ $banner->image }}')">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-9 offset-lg-3 col-12">
                </div>
            </div>
        </div>
    </div>
    <!--/ End Single Slider -->
</section>
<!--/ End Slider Area -->