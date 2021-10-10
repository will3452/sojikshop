<?php

namespace App\Http\Controllers;

use App\Models\BuyingRequest;
use Illuminate\Http\Request;

class BuyingServiceController extends Controller
{
    public function showForm()
    {
        return view('buying_form');
    }

    public function submitForm(){
        $data = request()->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'item_name'=>'required',
            'item_quantity'=>'required',
            'item_description'=>'required',
            'item_image'=>''
        ]);

        //attach user if authenticated
        if(auth()->check()){
            $data['user_id'] = auth()->id();
        }

        //store image
        if(request()->has('item_image')){
            $data['item_image'] = request()->item_image->store('public');
        }

        //generate json
        $productDetails = [
            'name'=>$data['item_name'],
            'description'=>$data['item_description'],
            'quantity'=>$data['item_quantity'],
            'image'=>$data['item_image']
        ];

        $customerDetails = [
            'name'=>$data['name'],
            'email'=>$data['email'],
            'mobile'=>$data['mobile'],
        ];

        BuyingRequest::create([
            'user_id'=>$data['user_id'],
            'product_details'=>json_encode($productDetails),
            'customer_details'=>json_encode($customerDetails),
        ]);

        alert('Your Form has been submitted, we will update you through your given information', 'success');
        return redirect('/');
    }
}
