@props(['type'])
@guest
    <span
    class="animate-bounce inline-block h-2 bg-yellow-300 text-white rounded-2xl p-1"
    ></span>
@endguest

@auth
    @if (auth()->user()->carts()->count() && $type == 'cart')
    <span
    class="animate-bounce inline-block h-2 bg-yellow-300 text-white rounded-2xl p-1"
    ></span>
    @endif
    @if (auth()->user()->wishlists()->count() && type=='heart')
    <span
    class="animate-bounce inline-block h-2 bg-yellow-300 text-white rounded-2xl p-1"
    ></span>
    @endif
@endauth
