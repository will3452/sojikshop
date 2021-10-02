<?php

namespace App\Supports;

use App\Models\Invoice;

class InvoiceSupport
{
    public static function createInvoice($request, $userId)
    {
        $hasInvoice = Invoice::where('txn_id', $request->txn_id)->first();

        if ($hasInvoice) {
            return null;
        }

        $invoice = Invoice::create([
            'txn_id'=>$request->txn_id,
            'user_id'=>$userId,
            'payer_email'=>$request->payer_email,
            'payer_first_name'=>$request->first_name,
            'payer_last_name'=>$request->last_name,
            'payment_fee'=>$request->payment_fee,
            'payment_gross'=>$request->payment_gross,
            'payment_type'=>$request->payment_type,
            'shipping'=>$request->shipping,
            'payment_created_at'=>now(),
            'num_cart_items'=>$request->num_cart_items,
        ]);

        return $invoice;
    }
}
