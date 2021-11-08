<?php

namespace App\Supports;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Invoice as ModelsInvoice;

class Invoice
{
    public static function getCart($id)
    {
        return User::find($id)->carts;
    }

    public static function getItems($userId)
    {
        $carts = self::getCart($userId);
        $items = [];
        foreach ($carts as $cart) {
            $items['products'][] = [
                'image'=>$cart->product->image,
                'name'=>$cart->product->name,
                'price'=>$cart->product->price,
                'quantity'=>$cart->quantity,
            ];
        }

        return $items;
    }

    public static function createInvoice($payload)
    {
        $typeOfOrder = $payload->typeOfOrder;

        if ($payload->order_status == Order::STATUS_PRE_ORDER) {
            $product = Product::find($payload->product_id);
            $quantity = $payload->quantity;
            $items['products'][] = [
                'image'=>$product->image,
                'name'=>$product->name,
                'price'=>$product->price,
                'quantity'=>$quantity,
            ];
            $items['summary'] = [
                'total'=>$payload->amount,
                'shipping_fee'=>$payload->shipping_fee,
                'grand_total'=>$payload->amount + $payload->shipping_fee
            ];
        } else {
            $items = self::getItems($payload->user_id);
            $items['summary'] = [
                'total'=>$payload->amount,
                'shipping_fee'=>$payload->shipping_fee,
                'grand_total'=>$payload->amount + $payload->shipping_fee
            ];
        }

        $invoice = ModelsInvoice::create([
            'txnid'=>$payload->id,
            'user_id'=>$payload->user_id,
            'amount'=>$payload->amount,
            'items'=>json_encode($items),
            'number_of_items'=>count($items),
            'type'=>$typeOfOrder,
        ]);

        return $invoice;
    }
}
