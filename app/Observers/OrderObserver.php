<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Order;
use App\Mail\OrderStatusUpdate;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    public function updated(Order $order){
        $user = User::find($order->user_id);
        Mail::to($user)->send(new OrderStatusUpdate($user, $order));
    }
}
