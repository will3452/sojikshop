<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class myPreOrderController extends Controller
{
    public function list()
    {
        $preOrders = Order::where([
                        'user_id'=>auth()->id(),
                        'status'=>Order::STATUS_PRE_ORDER
                    ])->orWhere('type', Order::STATUS_PRE_ORDER)->latest()->get();

        return view('my_pre_order', compact('preOrders'));
    }
}
