<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Invoice;
use App\Mail\NewInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class InvoiceObserver
{
    public function created(Invoice $invoice)
    {
        $user = User::find($invoice->user_id);
        Mail::to($user)->send(new NewInvoice($invoice, $user));


        //test data
        $data = [
            1,2,3,4,5,6,7,8,9,10,11
        ];

        $months = collect($data);
        $invoice->update([
            'created_at' => Carbon::parse("1-". $months->random(1)->first() . "-2021"),
        ]);
    }
}
