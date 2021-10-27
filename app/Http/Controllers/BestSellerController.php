<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BestSellerController extends Controller
{
    public function bestSeller()
    {
        $products = Product::orderBy('sell_count', 'DESC')->take(10)->get();
        return view('best_seller', compact('products'));
    }
}
