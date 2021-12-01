<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, LogsActivity;
    protected static $logAttributes = ['name', 'quantity', 'reference_number', 'price'];
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishLists()
    {
        return $this->hasMany(WishList::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function shippingFees()
    {
        return $this->hasMany(ShippingFee::class);
    }

    public function discounts()
    {
        return $this->hasMany(ProductDiscount::class);
    }

    public function getDiscountedPriceAttribute()
    {
        if (!$this->discounts()->first()) {
            return false;
        }
        return $this->price - (($this->discounts()->first()->discount->discount / 100) * $this->price);
    }


    public function getNormalPriceAttribute()
    {
        return $this->price;
    }

    public function hasDiscount()
    {
        return $this->discounts()->count() >= 1;
    }
}
