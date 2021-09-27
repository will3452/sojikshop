<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
@foreach (\App\Models\Banner::get() as $key=>$banner)
<img src="/storage/{{ $banner->image }}" id="slider-{{ $key }}" class="slider object-cover h-80 w-screen" alt="image" >
@endforeach


<script>
    let _count = 0;
    let _max_count = {{ count(\App\Models\Banner::get()) }};
    $('.slider').hide();
    $(`#slider-0`).fadeIn();
    $(function(){
        setInterval(function(){
            if(_count == _max_count){
                _count = 0;
            }
            $('.slider').hide();
            $(`#slider-${_count}`).fadeIn();
            _count++;
        }, 2000);
    });
</script>

  
<!-- end of banner -->
