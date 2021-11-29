<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        $invoice->with('order');
        $user = null;
        if(request()->has('user_id')) {
            $user = User::find(request()->user_id);
        } else {
            $user = auth()->user();
        }
        return view('invoice_show', compact('invoice', 'user'));
    }
}
