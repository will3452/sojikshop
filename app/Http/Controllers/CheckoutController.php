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
        $address = auth()->user()->addresses()->where('is_default', true)->first();
        $total = 0;
        $shipping = 0;
        $carts = auth()->user()->carts()->with('product')->latest()->get();
        $isPreOrder = false;
        foreach ($carts as $cart) {
            $addToTotal = $cart->product->price * $cart->quantity;
            if ($cart->product->is_pre_order) {
                $isPreOrder = true;
            }
            if ($cart->product->hasDiscount()) {
                $addToTotal = $cart->product->discounted_price * $cart->quantity;
            }
            $total += $addToTotal;
            if (request()->has('address_id')) {
                $address = auth()->user()->addresses()->findOrFail(request()->address_id);
                $shipping += ($address->getShippingFee($cart->product->id)) * $cart->quantity;
            } else {
                if (is_null($address)) {
                    alert('Setup your address first');
                    return back();
                }
                $shipping += ($address->getShippingFee($cart->product->id)) * $cart->quantity;
            }
        }
        $freeshipping = nova_get_setting('free_shipping', 0);
        if ($total >= $freeshipping) {
            $shipping = 0;
        }

        return view('checkout', compact('total', 'shipping', 'carts', 'address', 'isPreOrder'));
    }
}
