<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackagingOrder extends Order
{
    protected $table = 'orders';

    protected static function booted()
    {
        static::addGlobalScope('packaging-order', function (Builder $builder) {
            $builder->where('status', Order::STATUS_PACKAGING);
        });
    }
}
