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
        $step = null;
        if (request()->has('step')) {
            $step = request()->step + 1;
        } else {
            $step = 0;
        }
        //firts step
        $address = null;
        $area = null;
        if (request()->has('address') && request()->has('area')) {
            $address = request()->address;
            $area = request()->area;
        }

        //second step


        $total = 0;
        $shipping = 0;

        if (request()->has('area')) {
            $shipping = Area::find(request()->area)->shippingFee->amount;
        }


        // vat
        $vat = nova_get_setting('vat') ?? 12;
        $vatRate = $vat / 100;

        $carts = auth()->user()->carts()->with('product')->latest()->get();

        $productShippingFeeTotal = 0;

        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
            $productShippingFeeTotal += $cart->product->shipping_fee * $cart->quantity;
        }

        $shipping += $productShippingFeeTotal;

        $totalVat = $total * $vatRate;

        $total = $total + $totalVat;

        return view('checkout', compact('total', 'shipping', 'totalVat', 'step', 'carts', 'area', 'address'));
    }
}
