<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCompleted extends Order
{
    protected $table = 'orders';

    protected static function booted()
    {
        static::addGlobalScope('order-completed', function (Builder $builder) {
            $builder->where('status', Order::STATUS_COMPLETED);
        });
    }
}
