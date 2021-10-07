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
        //firts step
        $address = null;
        $area = null;
        if (request()->has('address') && request()->has('area')) {
            $address = request()->address;
            $area = request()->area;
        }

        //second step

        $carts = auth()->user()->carts()->with('product')->latest()->get();

        return view('checkout', compact('carts', 'area', 'address'));
    }
}
