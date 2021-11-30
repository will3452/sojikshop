<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuyingRequest;

class ApiBuyingServiceController extends Controller
{
    public function submitForm()
    {
        $data = request()->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'item_name'=>'required',
            'item_quantity'=>'required',
            'item_description'=>'required',
        ]);

        //attach user if authenticated
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }


        //generate json
        $productDetails = [
            'name'=>$data['item_name'],
            'description'=>$data['item_description'],
            'quantity'=>$data['item_quantity'],
        ];

        $customerDetails = [
            'name'=>$data['name'],
            'email'=>$data['email'],
            'mobile'=>$data['mobile'],
        ];

        BuyingRequest::create([
            'user_id'=>$data['user_id'] ?? null,
            'product_details'=>json_encode($productDetails),
            'customer_details'=>json_encode($customerDetails),
        ]);

        return response([
            'result'=>'success'
        ], 200);
    }
}
