<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $casts = [
        'expired_at'=>'datetime'
    ];

    public function products()
    {
        return $this->hasMany(ProductDiscount::class);
    }
}
