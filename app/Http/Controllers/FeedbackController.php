<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function writeFeedback(Order $order)
    {
        $orderProducts = $order->orderProducts;
        return view('write_feedback', compact('order', 'orderProducts'));
    }

    public function saveFeedback(Order $order)
    {
        $user = User::find($order->user_id);
        $feedbacks = [];
        foreach (request()->product_id as $key => $value) {
            $feedbacks[] = $user->feedbacks()->create([
                'product_id'=>request()->product_id[$key],
                'star'=>request()->star[$key],
                'message'=>request()->message[$key]
            ]);
        }

        return 'feedback submitted!';
    }
}
