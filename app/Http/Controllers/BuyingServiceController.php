<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BuyingRequest;

class BuyingServiceController extends Controller
{
    public function showForm()
    {
        return view('buying_form');
    }

    public function index()
    {
        if (request()->has('user_id')) {
            $user = User::find(request()->user_id);
        } else {
            $user = auth()->user();
        }

        return view('my_requests', compact('user'));
    }

    public function submitForm()
    {
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
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        //store image
        if (request()->has('item_image')) {
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
            'user_id'=>$data['user_id'] ?? null,
            'product_details'=>json_encode($productDetails),
            'customer_details'=>json_encode($customerDetails),
        ]);

        alert('Your Form has been submitted, we will update you through your given information', 'success');
        return redirect('/');
    }

    public function payRequest(BuyingRequest $buyingRequest)
    {
        $address = auth()->user()->addresses()->where('is_default', true)->first();
        $total = 0;

        $total += $buyingRequest->unit_cost * json_decode($buyingRequest->product_details)->quantity;
        if (request()->has('address_id')) {
            $address = auth()->user()->addresses()->findOrFail(request()->address_id);
        } else {
            if (is_null($address)) {
                alert('Setup your address first');
                return back();
            }
        }

        return view('checkout-request', compact('total', 'buyingRequest', 'address'));
    }

    public function showReceipt(BuyingRequest $buyingRequest)
    {
        return view('buying-receipt', compact('buyingRequest'));
    }
}
