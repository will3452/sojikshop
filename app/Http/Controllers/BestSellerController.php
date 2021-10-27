<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BestSellerController extends Controller
{
    public function bestSeller()
    {
        $max = 1;

        $products = collect([]);

        $ps = Product::withCount('orderProducts')->get();

        foreach ($ps as $p) {
            if ($p->orderProducts_count >= $max) {
                $products->push($p);
            }
        }


        return view('best_seller', compact('products'));
    }
}
