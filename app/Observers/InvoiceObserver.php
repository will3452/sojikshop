<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Invoice;
use App\Mail\NewInvoice;
use Illuminate\Support\Facades\Mail;

class InvoiceObserver
{
    public function created(Invoice $invoice){
        $user = User::find($invoice->user_id);
        Mail::to($user)->send(new NewInvoice($invoice, $user));
    }
}
