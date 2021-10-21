<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function addFee($totalCost)
    {
        return $totalCost;
    }

    public function checkout()
    {
        $address = auth()->user()->addresses()->where('is_default',true)->first();
        $total = 0;
        $shipping = 0;
        $carts = auth()->user()->carts()->with('product')->latest()->get();

        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
            if(request()->has('address_id')){
                $address = auth()->user()->addresses()->findOrFail(request()->address_id);
                $shipping += ($address->getShippingFee($cart->product->id)) * $cart->quantity;
            }else {
                $shipping += ($address->getShippingFee($cart->product->id)) * $cart->quantity;
            }
        }

        return view('checkout', compact('total', 'shipping','carts', 'address'));
    }
}
