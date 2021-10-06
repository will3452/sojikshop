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
        $carts = auth()->user()->carts()->with('product')->latest()->get();
        $totalCost = 0;

        $addressShippingFee = null;

        if (!request()->has('shippingfee')) {
            $addressShippingFee = Area::first()->shippingFee->amount;
        } else {
            $addressShippingFee = Area::where('code', request()->shippingfee)->first()->shippingFee()->amount;
        }

        $productShippingFee = 0;
        foreach ($carts as $cart) {
            $totalCost += ($cart->quantity * $cart->product->price);
            $productShippingFee += $cart->product->shipping_fee;
        }

        $totalShippingFee = $addressShippingFee + $productShippingFee;

        $totalCost += $totalShippingFee;

        $totalCost = $this->addFee($totalCost);
        $areas = Area::get();

        return view('checkout', compact('totalCost', 'carts', 'areas', 'totalShippingFee', 'addressShippingFee'));
    }
}
