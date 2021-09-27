@props(['product'])
<a
    href="#"
    class="
    block
    h-52
    m-2
    w-2/5
    md:h-80
    md:w-1/6
    rounded-lg
    shadow-2xl
    flex-none
    relative
    overflow-hidden
    "
    style="background:url('/storage/{{ $product->image }}');
    background-size:contain;background-position:top center;background-repeat:no-repeat"
    >
    <div class="
    bg-gradient-to-r from-purple-400 to-pink-500
    px-2 absolute bottom-0 w-full text-center text-xs font-bold uppercase py-2 text-white">
        {{ $product->name }}
    </div>
</a>