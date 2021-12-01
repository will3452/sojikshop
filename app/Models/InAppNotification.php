<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InAppNotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'title',
        'message',
        'received_at',//nullable
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsReceived()
    {
        $this->received_at = now();
        $this->save();
    }
}
