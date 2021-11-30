<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class myPreOrderController extends Controller
{
    public function list()
    {
        $user = null;
        if (request()->has('user_id')) {
            $user = User::findOrFail(request()->user_id);
        } else {
            $user = auth()->user();
        }
        $preOrders = Order::where([
                        'user_id'=>$user->id,
                        'status'=>Order::STATUS_PRE_ORDER
                    ])->orWhere('type', Order::STATUS_PRE_ORDER)->latest()->get();

        return view('my_pre_order', compact('preOrders'));
    }
}
