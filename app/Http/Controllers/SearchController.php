<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        $keyword = request()->keyword;

        $products = Product::where('name', 'LIKE', '%'.$keyword.'%')
        ->orWhere('description', 'LIKE', '%'.$keyword.'%')
        ->get();

        return view('search_result', compact('products'));
    }

    public function getCategory()
    {
        $keyword = request()->category;

        $category = Category::where('name', $keyword)
        ->with('products')
        ->first();

        return view('category_result', compact('category'));
    }
}
