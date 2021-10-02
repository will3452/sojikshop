<?php

namespace App\Supports;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Str;

class OrderSupport
{
    public static function generateReferenceNumber()
    {
        $lastId = Order::latest()->first()->id ?? 1;
        return  "SJKS-". Str::padLeft("$lastId", 8, '0');
    }

    public static function destroyCart($carts)
    {
        foreach ($carts as $cart) {
            Cart::find($cart->id)->delete();
        }
    }
    public static function createOrder($invoiceId, $userId, $carts)
    {
        $ref = self::generateReferenceNumber();

        $order = Order::create([
            'user_id' => $userId,
            'invoice_id' => $invoiceId,
            'reference_number' => $ref,
        ]);

        self::addProducts($order, $carts);

        self::destroyCart($carts);

        return $order;
    }

    public static function addProducts($order, $carts)
    {
        foreach ($carts as $cart) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id'=>$cart->product_id,
                'quantity'=>$cart->quantity,
                'amount'=>$cart->quantity * $cart->product->price
            ]);
        }
    }
}
