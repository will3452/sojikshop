<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
            <a class="navbar-brand" href="#">SojiKShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach (\App\Models\Category::get() as $item)
                            <a href="#" class="dropdown-item">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="badge badge-danger animate__heartBeat animate__infinite">2</span> My Cart
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa fa-heart"></i> My Wishlist
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa fa-user"></i> My Account
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>