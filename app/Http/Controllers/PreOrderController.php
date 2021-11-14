<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Product;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    public function checkIfValid($product)
    {
        if ($product->quantity != 0) {
            alert('Something went wrong!');
            return back();
        }
    }
    public function setPreOrder(Product $product)
    {
        $this->checkIfValid($product);
        return view('set_preorder', compact('product'));
    }

    public function payPreOrder()
    {
        $data = request()->validate([
            'quantity'=>'min:1,required',
            'product_id'=>'required'
        ]);

        $product = Product::findOrFail(request()->product_id);

        $this->checkIfValid($product);


        $address = auth()->user()->addresses()->where('is_default', true)->first();
        $total = 0;
        $shipping = 0;

        $total += $product->price * $data['quantity'];
        if (request()->has('address_id')) {
            $address = auth()->user()->addresses()->findOrFail(request()->address_id);
            $shipping += ($address->getShippingFee($product->id)) * $product->quantity;
        } else {
            if (is_null($address)) {
                alert('Setup your address first');
                return back();
            }
            $shipping += ($address->getShippingFee($product->id)) * $data['quantity'];
        }

        $freeshipping = nova_get_setting('free_shipping', 0);
        if ($total >= $freeshipping) {
            $shipping = 0;
        }

        return view('checkout', compact('total', 'shipping', 'product', 'address'));
    }
}
