<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiFeedbackController extends Controller
{
    public function saveFeedback(Order $order)
    {
        $product = Product::where('name', request()->product_name)->first();

        auth()->user()->feedbacks()->create([
            'product_id'=>$product->id,
            'star'=>request()->star,
            'message'=>request()->message,
        ]);

        return response([
            'result' => 'success',
        ], 200);
    }
}
