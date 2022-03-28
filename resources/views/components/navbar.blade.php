<!-- navbar -->
    <nav
    x-data="{isShow:false}"
    id="navbar"
    class="
        sticky
        md:sticky
        top-0
        md:relative
        flex
        justify-between
        items-center
        p-2
        md:p-6
        bg-blue-800
        z-50
    "
    >
    <div class="flex items-center">
        {{-- <a href="/" class="transform rotate-90 block">
        <span class="material-icons text-blue-200 "> polymer </span>
        </a> --}}
        <a href="/" title="Home" class="mx-1">
            <img src="/storage/{{nova_get_setting('logo')}}" alt="" class="mx-auto w-10 h-10 ">
        </a>
        @auth
            <span class="font-bold text-blue-200" style="font-style: italic;">
                Hello, {{auth()->user()->name}}
            </span>
        @endauth
    </div>
    <div>
        @auth
        <a href="/chat/1#latest" class="px-2">
            <span class="material-icons text-blue-200"> mail </span>
        </a>
        @endauth
        <a href="{{route('my.wishlist')}}" class="px-2">
        <span class="material-icons text-blue-200"> favorite </span>
        <x-dot type="heart"></x-dot>
        </a>
        <a href="/my-cart" class="px-2">
        <span class="material-icons text-blue-200"> shopping_cart </span>
        <x-dot type="cart"></x-dot>
        </a>
        <a href="#" class="px-2 items-center" @click.prevent="isShow = !isShow" x-show="!isShow">
        <span class="material-icons text-blue-200"> account_circle </span>
        </a>
        <a href="#" class="px-2 items-center" @click.prevent="isShow = !isShow" x-show="isShow">
            <span class="material-icons text-yellow-300"> account_circle </span>
        </a>
    </div>
    <div x-show="isShow" class="shadow-2xl bg-white w-2/3 md:w-1/5 z-50 fixed top-11 md:top-20 border-t-4 border-blue-500 right-0 rounded-b-xl text-center uppercase">
        @guest
        <a href="{{ route('login') }}" class="block hover:bg-blue-900 hover:text-blue-200 py-2">Login</a>
        <a href="{{ route('register') }}" class="block hover:bg-blue-900 hover:text-blue-200 py-2">Register</a>
        @endguest

        @auth
        <a href="/profile" class="block hover:bg-blue-900 hover:text-blue-200 py-2">Profile</a>
        <a href="{{ route('my-requests') }}" class="block hover:bg-blue-900 hover:text-blue-200 py-2">My Requests</a>
        <a href="{{ route('my-orders') }}" class="block hover:bg-blue-900 hover:text-blue-200 py-2">My Orders</a>
        <a href="/my-pre-orders" class="block hover:bg-blue-900 hover:text-blue-200 py-2">Pre-Orders</a>
        <a href="{{ route('logout') }}" class="block hover:bg-blue-900 hover:text-blue-200 py-2">Logout</a>
        @endauth
    </div>
    </nav>


<!-- end of navbar -->
