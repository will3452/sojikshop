<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function myOrders()
    {
        $statuses = [Order::STATUS_DELIVERY, Order::STATUS_FEEDBACK, Order::STATUS_PACKAGING, Order::STATUS_PRE_ORDER, Order::STATUS_COMPLETED];
        if (!request()->has('active') || !in_array(request()->active, $statuses)) {
            return redirect(route('my-orders').'?active='.Order::STATUS_PACKAGING);
        }
        $orders = [];
        if (request()->active == Order::STATUS_PACKAGING) {
            $orders = Order::where([
                'user_id'=>auth()->id(),
                'status'=>request()->active,
            ])->where('type', '!=', Order::STATUS_PRE_ORDER)->latest()->get();
        } else {
            $orders = Order::where([
                'user_id'=>auth()->user()->id,
                'status'=>request()->active
            ])->latest()->get();
        }

        foreach ($orders as $order) {
            $order->json_items = json_decode($order->items);
            $order->delivery_info = $order->delivery->with('courier');
        }



        return response([
            'orders' => $orders
        ], 200);
    }
}
