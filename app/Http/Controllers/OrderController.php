<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ReturnReason;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function myOrders()
    {
        $statuses = [Order::STATUS_DELIVERY, Order::STATUS_FEEDBACK, Order::STATUS_PACKAGING, Order::STATUS_PRE_ORDER, Order::STATUS_COMPLETED];
        if (!request()->has('active') || !in_array(request()->active, $statuses)) {
            return redirect(route('my-orders').'?active='.Order::STATUS_PACKAGING);
        }

        $orders = Order::where([
            'user_id'=>auth()->id(),
            'status'=>request()->active
        ])->latest()->get();

        return view('my_orders', compact('orders'));
    }

    public function markAsCompleted(Order $order)
    {
        $order->markAsComplete();
        alert('Done!');

        return back();
    }

    public function returnOrder(Order $order)
    {
        return view('return_order', compact('order'));
    }

    public function postReturnOrder(Order $order)
    {
        $data = request()->validate([
            'reason'=>'required|max:200',
            'attachment'=>''
        ]);

        $data['attachment'] = $data['attachment']->store('public');

        ReturnReason::create([
            'user_id'=>auth()->id(),
            'reason'=>$data['reason'],
            'order_id'=>$order->id,
            'attachment'=>$data['attachment']
        ]);

        $order->markAsReturn();

        alert('Form submitted, We will message you soon.');

        return redirect('/my-orders');
    }
}
