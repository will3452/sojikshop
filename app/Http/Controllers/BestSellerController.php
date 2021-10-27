<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BestSellerController extends Controller
{
    public function bestSeller()
    {
        $max = nova_get_setting('best_seller_count') ?? 2;

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
