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
        return "$this->street, $this->barangay, $this->city - $this->postal_code ($this->region)";
    }
}