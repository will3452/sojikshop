<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function area(){
        return $this->belongsTo(Area::class);
    }
}
