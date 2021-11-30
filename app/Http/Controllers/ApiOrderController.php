<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ReturnReason;
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
                'status'=>request()->active,
            ])->latest()->get();
        }
        foreach ($orders as $order) {
            $order->json_items = json_decode($order->items);
            foreach ($order->json_items->products as $item) {
                $item->product_id = \App\Models\Product::where('name', $item->name)->first()->id;
                $item->order_id = $order->id;
            }
            if (request()->active == Order::STATUS_DELIVERY) {
                $order->delivery_info = $order->delivery;
                $order->courier_info = $order->delivery->courier;
            }
        }


        return response([
            'orders' => $orders
        ], 200);
    }

    public function markAsCompleted(Order $order)
    {
        $order->markAsComplete();

        return response([
            'order' => $order,
        ], 200);
    }

    public function postReturnOrder(Order $order)
    {
        $data = request()->validate([
            'reason'=>'required|max:200',
        ]);

        ReturnReason::create([
            'user_id'=>auth()->id(),
            'reason'=>$data['reason'],
            'order_id'=>$order->id,
        ]);

        $order->markAsReturn();

        return response([
            'order' => $order,
        ], 200);
    }
}
