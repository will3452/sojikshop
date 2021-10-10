<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courier extends User
{
    protected $guarded = [];
    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('courier', function (Builder $builder) {
            $builder->whereType(User::COURIER);
        });
    }
}
