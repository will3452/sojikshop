<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_PRE_ORDER = 'pre-order';
    const STATUS_PACKAGING = 'packaging';
    const STATUS_DELIVERY = 'delivery';
    const STATUS_FEEDBACK = 'feedback';
    const STATUS_COMPLETED = 'completed';
    const STATUS_RETURN = 'return';

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

    public function getAmountAttribute()
    {
        $invoice = Invoice::find($this->invoice_id);
        return $invoice->amount ?? '';
    }

    public function returnReason()
    {
        return $this->hasOne(ReturnReason::class);
    }

    public function markAsComplete()
    {
        $this->update([
            'status'=>self::STATUS_COMPLETED
        ]);
    }

    public function markAsReturn()
    {
        $this->update([
            'status'=>self::STATUS_RETURN
        ]);
    }
}
