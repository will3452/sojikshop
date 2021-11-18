<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

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
            return $q->status == Order::STATUS_COMPLETED;
        })->whereYear('created_at', '=', now()->format('Y'))->orderBy('created_at')->get()->groupBy(function ($e) {
            return $e->created_at->format('M');
        });
    }
}
