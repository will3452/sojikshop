<?php

namespace App\Supports;

use App\Models\Invoice as ModelsInvoice;
use App\Models\User;

class Invoice {

    public static function getCart($id){
        return User::find($id)->carts;
    }

    public static function getItems($userId){
        $carts = self::getCart($userId);
        $items = [];
        foreach ($carts as $cart) {
            $items[] = [
                'product_image'=>$cart->product->image,
                'product_name'=>$cart->product->name,
                'product_price'=>$cart->product->price,
                'quantity'=>$cart->quantity,
            ];
        }

        return $items;
    }

    public static function createInvoice($payload){
        $items = self::getItems($payload->user_id);
        $invoice = ModelsInvoice::create([
            'txnid'=>$payload->id,
            'user_id'=>$payload->user_id,
            'amount'=>$payload->amount,
            'items'=>json_encode($items),
            'number_of_items'=>count($items)
        ]);

        return $invoice;
    }
}
