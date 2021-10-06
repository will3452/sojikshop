<div class="h-20 bg-gradient-to-r from-pink-500 to-purple-900 relative">
    <form action="{{route('search')}}" class="mx-auto md:w-1/2 md:left-1/4 w-full p-2 absolute -top-6">
        <input type="text" name="keyword" required id="_search_bar" class="w-full p-3 rounded-full focus:bg-yellow-200 focus:outline-none">
        <button class="absolute right-3 top-3 bg-purple-900 w-10 h-10 text-white rounded-full">
            <span class="material-icons">
                search
            </span>
        </button>
    </form>
    <div class="absolute bottom-3 w-full">
        <div class="text-center">
            @foreach (\App\Models\Category::inRandomOrder()->take(3)->get() as $category)
                <a href="{{route('search.category', ['category' => $category->name])}}" class="text-xs uppercase p-1 px-2 bg-pink-600 text-white rounded-full cursor-pointer mx-2 border-2 border-white">
                    {{$category->name}}
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
