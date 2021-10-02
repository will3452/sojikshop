<?php

namespace App\Http\Controllers;

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

        foreach ($carts as $cart) {
            $totalCost += ($cart->quantity * $cart->product->price);
        }

        $totalCost = $this->addFee($totalCost);

        return view('checkout', compact('totalCost', 'carts'));
    }
}
