<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Product $product){
        Cart::create([
            'quantity'=>1,
            'total_cost'=>$product->price,
            'product_id'=>$product->id,
            'user_id'=>auth()->id()
        ]);
        alert('The Product has been added to your Cart!', 'success');
        return back();
    }

    public function myCart(){
        $carts = auth()->user()->carts()->latest()->get();
        return view('cart_list', compact('carts'));
    }
}
