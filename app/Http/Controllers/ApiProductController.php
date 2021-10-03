<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        if (request()->has('_limit')) {
            $products = Product::limit(request()->limit)->get();
        }

        return response([
            'products'=>$products,
        ], 200);
    }
}
