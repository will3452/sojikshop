<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return self::whereYear('created_at', '=', now()->format('Y'))->get()->groupBy(function ($e) {
            return $e->created_at->format('M');
        });
    }
}
