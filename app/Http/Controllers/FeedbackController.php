<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $feedbacks = [];
        foreach (request()->product_id as $key => $value) {
            $feedbacks[] = auth()->user()->feedbacks()->create([
                'product_id'=>request()->product_id[$key],
                'star'=>request()->star[$key],
                'message'=>request()->message[$key]
            ]);
        }

        alert('Thanks, Your Feedback has been submitted!');
        return redirect('/');
    }
}
