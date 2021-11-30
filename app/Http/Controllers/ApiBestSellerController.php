<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiBestSellerController extends Controller
{
    public function bestSeller()
    {
        $products = Product::where('sell_count', '!=', 0)->orderBy('sell_count', 'DESC')->take(10)->get();
        return response([
            'products' => $products,
        ], 200);
    }
}
