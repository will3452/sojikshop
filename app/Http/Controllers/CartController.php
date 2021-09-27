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

    public function removeToCart(Cart $cart){
        $cart->delete();
        alert('Product has been removed to your Cart!', 'success');
        return back();
    }

    public function myCart(){
        $totalCost = 0;
        $carts = auth()->user()->carts()->with('product')->latest()->get();
        foreach($carts as $cart){
            $totalCost += $cart->product->price * $cart->quantity;
        }
        return view('cart_list', compact('carts', 'totalCost'));
    }

    public function increaseQuantity(Cart $cart){
        $qty = $cart->quantity + 1;
        if($qty > $cart->product->quantity){
            alert("Can't Increase Quantity!", 'error');
            return back();
        }
        $cart->update([
            'quantity'=>$qty
        ]);

        return redirect('/my-cart#cart'.$cart->id);
    }

    public function decreaseQuantity(Cart $cart){
        $qty = $cart->quantity - 1;
        if($qty <= 0){
            alert("Can't Increase Quantity!", 'error');
            return back();
        }
        $cart->update([
            'quantity'=>$qty
        ]);

        return redirect('/my-cart#cart'.$cart->id);
    }
}
