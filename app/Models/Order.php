<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const STATUS_PACKAGING = 'packaging';
    const STATUS_DELIVERY = 'delivery';
    const STATUS_FEEDBACK = 'feedback';

    const TYPE_PRE_ORDER = 'pre-order';
    const TYPE_ORDER ='order';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
