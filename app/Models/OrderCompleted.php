<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCompleted extends Invoice
{
    protected $table = 'invoices';

    protected static function booted()
    {
        static::addGlobalScope('order-completed', function (Builder $builder) {
            $ordersId = Order::where('status', Order::STATUS_COMPLETED)->get()->pluck('invoice_id')->toArray();
            $builder->whereHas('order', function (Builder $q) use ($ordersId) {
                return $q->whereIn('id', $ordersId);
            });
        });
    }
}
