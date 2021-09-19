<div class="search-bar-top">
    <div class="search-bar">
        <select>
            <option selected="selected">All Category</option>
            @foreach (\App\Models\Category::get() as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <form>
            <input name="search" placeholder="Search Products Here....." type="search">
            <button class="btnn"><i class="ti-search"></i></button>
        </form>
    </div>
</div>