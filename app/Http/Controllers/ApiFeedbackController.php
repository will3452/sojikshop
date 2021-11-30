<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ApiFeedbackController extends Controller
{
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

        return response([
            'result' => 'success',
        ], 200);
    }
}
