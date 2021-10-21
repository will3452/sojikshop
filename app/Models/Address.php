<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getInlineAddressAttribute()
    {
        return "$this->house_number,  $this->street, $this->building, $this->barangay, $this->city - $this->postal_code ($this->region)";
    }

    public function removeDefault()
    {
        $this->update([
            'is_default'=>false
        ]);
    }

    public function setDefault()
    {
        $this->update([
            'is_default'=>true
        ]);
    }

    public function getShippingFee($productId){
        $region = Region::where('name', $this->region)->first();
        $shipping = ShippingFee::where([
            'product_id'=>$productId,
            'region_id'=>$region->id,
        ])->first();

        return $shipping ? $shipping->amount : 0;
    }
}
