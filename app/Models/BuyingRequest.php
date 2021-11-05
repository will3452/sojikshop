<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    const STATUS_PENDING = 'pending';
    const STATUS_FOUND = 'found';
    const STATUS_NOT_FOUND = 'not found';
    const STATUS_PAID = 'paid';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
