<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {
        $isPreOrder = false;
        if (auth()->user()->carts()->first()) {
            $isPreOrder = auth()->user()->carts()->first()->product->is_pre_order;
        }
        if ($isPreOrder != $product->is_pre_order) {
            foreach (auth()->user()->carts as $cart) {
                $cart->delete();
            }
        }
        Cart::create([
            'quantity'=>1,
            'total_cost'=>$product->price,
            'product_id'=>$product->id,
            'user_id'=>auth()->id()
        ]);
        alert('The Product has been added to your Cart!');
        return back();
    }

    public function removeToCart(Cart $cart)
    {
        $cart->delete();
        return back();
    }

    public function myCart()
    {
        $carts = auth()->user()->carts()->with('product')->latest()->get();
        return view('cart_list', compact('carts'));
    }

    public function increaseQuantity(Cart $cart)
    {
        $qty = $cart->quantity + 1;
        if ($qty > $cart->product->quantity) {
            alert("Can't Increase Quantity!");
            return back();
        }
        $cart->update([
            'quantity'=>$qty
        ]);

        return redirect('/my-cart#cart'.$cart->id);
    }

    public function decreaseQuantity(Cart $cart)
    {
        $qty = $cart->quantity - 1;
        if ($qty <= 0) {
            alert("Can't Increase Quantity!");
            return back();
        }
        $cart->update([
            'quantity'=>$qty
        ]);

        return redirect('/my-cart#cart'.$cart->id);
    }
}
