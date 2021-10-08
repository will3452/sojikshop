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

        $carts = auth()->user()->carts()->with('product')->latest()->get();

        return view('checkout', compact('step', 'carts', 'area', 'address'));
    }
}
