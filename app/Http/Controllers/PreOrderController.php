<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Product;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    public function checkIfValid($product)
    {
        if($product->quantity != 0) {
            alert('Something went wrong!', 'danger');
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


        $step = null;
        if (request()->has('step')) {
            $step = request()->step + 1;
        } else {
            $step = 0;
        }
        //firts step
        $address = null;
        $area = null;
        if (request()->has('address') && request()->has('area')) {
            $address = request()->address;
            $area = request()->area;
        }

        //second step

        $total = 0;
        $shipping = 0;

        if (request()->has('area')) {
            $shipping = Area::find(request()->area)->shippingFee->amount;
        }


        // vat
        $vat = nova_get_setting('vat') ?? 12;
        $vatRate = $vat / 100;

        $total = $product->price * $data['quantity'];
        $productShippingFeeTotal = $product->shipping_fee * $data['quantity'];

        $shipping += $productShippingFeeTotal;

        $totalVat = $total * $vatRate;

        $total = $total + $totalVat;

        return view('checkout', compact('total', 'shipping', 'totalVat', 'step', 'product', 'area', 'address'));

    }
}
