<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Order;
use App\Mail\OrderStatusUpdate;
use App\Models\InAppNotification;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    public function updated(Order $order)
    {
        $user = User::find($order->user_id);
        Mail::to($user)->send(new OrderStatusUpdate($user, $order));

        # Order Update
        $title = "Order with ref #" . $order->reference_number . " status update!";
        $message = nova_get_setting('packaging_mail_message') ?? 'Packaging!';

        if ($order->status == Order::STATUS_DELIVERY) {
            $message = nova_get_setting('delivery_mail_message') ?? 'Delivery!';
        } elseif ($order->status == Order::STATUS_FEEDBACK) {
            $message = nova_get_setting('feedback_mail_message') ?? 'Feedback!';
        }

        InAppNotification::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'title' => $title,
             'message' => $message,
        ]);
    }

    public function created(Order $order)
    {
        $order->update([
            'created_at'=>$order->invoice->created_at,
        ]);
    }
}
