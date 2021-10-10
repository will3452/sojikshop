<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        if(request()->has('keyword')){
            $keyword = request()->keyword;
            $products = Product::where('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('description', 'LIKE', '%'.$keyword.'%')
                ->get();
        }

        if (request()->has('_limit')) {
            $products = Product::limit(request()->_limit)->get();
        }

        return response([
            'products'=>$products,
        ], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response([
                'product'=>[]
            ], 400);
        }
        return response([
            'product'=>$product,
        ], 200);
    }
}
