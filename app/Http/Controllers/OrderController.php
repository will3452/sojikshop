<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function myOrders()
    {
        $statuses = [Order::STATUS_DELIVERY, Order::STATUS_FEEDBACK, Order::STATUS_PACKAGING, Order::STATUS_PRE_ORDER];
        if (!request()->has('active') || !in_array(request()->active, $statuses)) {
            return redirect(route('my-orders').'?active='.Order::STATUS_PACKAGING);
        }

        $orders = Order::where([
            'user_id'=>auth()->id(),
            'status'=>request()->active
        ])->latest()->get();

        return view('my_orders', compact('orders'));
    }
}
