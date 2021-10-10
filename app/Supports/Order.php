<?php

namespace App\Supports;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use App\Models\Order as ModelsOrder;

class Order {

    public static function emptyCart($userid){
        $carts =User::find($userid)->carts;
        foreach ($carts as $cart) {
            $cart->delete();
        }
    }

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

    public static function deductProducts($userid){
        $items = self::getCart($userid);
        foreach ($items as $item) {
            $item->product->update([
                'quantity'=>$item->product->quantity - $item->quantity
            ]);
        }
    }

    public static function createReferenceNumber(){
        return now()->timestamp.Str::random(6);
    }

    public static function recordOrderProducts($orderid, $userid){
        $carts = self::getCart($userid);
        foreach ($carts as $cart) {
            OrderProduct::create([
                'order_id'=>$orderid,
                'product_id'=>$cart->product->id,
                'quantity'=>$cart->quantity,
                'amount'=>($cart->quantity * $cart->product->price) + $cart->product->shipping_fee
            ]);
        }
    }

    public static function createOrder($payload, $invoice_id){
        $items = self::getItems($payload->user_id);
        $location = [
            'shipping_address'=>$payload->shipping_address,
            'shipping_zip'=>$payload->shipping_zip,
            'shipping_area_id'=>$payload->shipping_area_id,
            'lat'=>$payload->lat,
            'lng'=>$payload->lng
        ];

        $order = ModelsOrder::create([
            'user_id'=>$payload->user_id,
            'invoice_id'=>$invoice_id,
            'reference_number'=>self::createReferenceNumber(),
            'items'=>json_encode($items),
            'location'=>json_encode($location)
        ]);

        //create connection between order and products
        self::recordOrderProducts($order->id, $payload->user_id);

        //reduction of product base on orders
        self::deductProducts($payload->user_id);

        //destroy cart
        self::emptyCart($payload->user_id);

        return $order;
    }
}
