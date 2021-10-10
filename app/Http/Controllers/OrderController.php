<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function myOrders()
    {
        $statuses = ['packaging', 'delivery', 'feedback'];
        if (!request()->has('active') || !in_array(request()->active, $statuses)) {
            return redirect(route('my-orders').'?active=packaging');
        }

        $orders = Order::where([
            'user_id'=>auth()->id(),
            'status'=>request()->active
        ])->latest()->get();

        return view('my_orders', compact('orders'));
    }
}
