<div class="h-20 bg-blue-800 relative">
    <form action="{{route('search')}}" class="mx-auto md:w-1/2 md:left-1/4 w-full p-2 absolute -top-6">
        <input type="text" name="keyword" required id="_search_bar" class="w-full p-3 rounded-full focus:bg-blue-200 focus:outline-none">
        <button class="absolute right-3 top-3 bg-blue-200 w-10 h-10 text-dark rounded-full">
            <span class="material-icons">
                search
            </span>
        </button>
    </form>
    <div class="absolute bottom-3 w-full">
        <div class="text-center flex justify-start md:justify-center overflow-y-auto items-center">
            <a href="/best-seller" class="flex-none text-xs uppercase p-1 px-2 bg-blue-200 text-blue-900 text-blue-900 rounded-full cursor-pointer mx-2 border-2 border-white">
                Best Sellers
            </a>
            <a href="/pre-order" class="flex-none text-xs uppercase p-1 px-2 bg-blue-200 text-blue-900 text-blue-900 rounded-full cursor-pointer mx-2 border-2 border-white">
                Pre-Order
            </a>
            <a href="/buying-request" class="flex-none text-xs uppercase p-1 px-2 bg-blue-200 text-blue-900 text-blue-900 rounded-full cursor-pointer mx-2 border-2 border-white">
                Buying Services
            </a>
            @foreach (\App\Models\Category::get() as $category)
                <a href="{{route('search.category', ['category' => $category->name])}}" class="text-xs uppercase p-1 px-2 bg-blue-200 text-blue-900 text-blue-900 rounded-full cursor-pointer mx-2 border-2 border-white flex-none">
                    {{$category->name}}
                </a>
            @endforeach

            @foreach (\App\Models\Discount::get() as $discount)
            <a href="/discount/{{$discount->id}}" class="text-xs uppercase p-1 px-2 bg-blue-200 text-blue-900 text-blue-900 rounded-full cursor-pointer mx-2 border-2 border-white flex-none">
                {{\Str::limit($discount->description, 20)}}
            </a>
            @endforeach

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.0/typed.min.js" integrity="sha512-zKaK6G2LZC5YZTX0vKmD7xOwd1zrEEMal4zlTf5Ved/A1RrnW+qt8pWDfo7oz+xeChECS/P9dv6EDwwPwelFfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var typed4 = new Typed('#_search_bar', {
        strings: [
            @foreach(\App\Models\Product::inRandomOrder()->take(7)->get() as $product)
            `{{\Str::limit($product->name,30)}}`,
            @endforeach
        ],
        typeSpeed: 100,
        backSpeed: 50,
        attr: 'placeholder',
        bindInputFocusEvents: true,
        loop: true
    });
</script>
