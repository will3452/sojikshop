<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ApiCartController extends Controller
{
    public function myCart()
    {
        $user = User::find(auth()->id());

        $carts = $user->carts;

        return response([
            'carts'=>$carts
        ], 200);
    }

    public function addToCart()
    {
        request()->validate([
            'product_id'=>'required'
        ]);

        $product = Product::find(request()->product_id);

        $cart = Cart::create([
            'quantity'=>1,
            'total_cost'=>$product->price,
            'product_id'=>$product->id,
            'user_id'=>auth()->id()
        ]);

        return response([
            'status'=>'created',
            'cart'=>$cart
        ], 200);
    }

    public function removeToCart()
    {
        request()->validate([
            'product_id'=>'required'
        ]);

        $user = User::find(auth()->id());

        $cart = $user->carts()->where('product_id', request()->product_id)->first();

        $cart->delete();
        return response([
            'status'=>'deleted'
        ], 200);
    }

    public function increaseQuantity(Cart $cart)
    {
        $qty = $cart->quantity + 1;
        if ($qty > $cart->product->quantity) {
            return response([
                'result' => 'error',
            ], 200);
        }
        $cart->update([
            'quantity'=>$qty
        ]);

        return response([
            'result' => 'success',
        ], 200);
    }

    public function decreaseQuantity(Cart $cart)
    {
        $qty = $cart->quantity - 1;
        if ($qty <= 0) {
            return response([
                'result' => 'error',
            ], 200);
        }
        $cart->update([
            'quantity'=>$qty
        ]);

        return response([
            'result' => 'success',
        ], 200);
    }
}
