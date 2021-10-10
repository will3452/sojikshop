<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Customer extends User
{
    protected $guarded = [];
    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('courier', function (Builder $builder) {
            $builder->whereType(User::CUSTOMER);
        });
    }
}
