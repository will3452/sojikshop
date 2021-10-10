<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreOrder extends Order
{
    use HasFactory;
    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope('pre-order', function (Builder $builder) {
            $builder->whereType(Order::TYPE_PRE_ORDER);
        });
    }
}
