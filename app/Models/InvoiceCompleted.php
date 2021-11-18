<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceCompleted extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public static function getMonthlyData()
    {
        return self::whereHas('order', function (Builder $q) {
            return $q->where('status', Order::STATUS_COMPLETED);
        })->whereYear('created_at', '=', now()->format('Y'))->orderBy('created_at')->get()->groupBy(function ($e) {
            return $e->created_at->format('M');
        });
    }

    protected static function booted()
    {
        static::addGlobalScope('invoice-completed', function (Builder $builder) {
            $builder->whereHas('order', function (Builder $q) {
                return $q->where('status', Order::STATUS_COMPLETED);
            });
        });
    }
}
