<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory, LogsActivity;
    protected static $logAttributes = ['name'];
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
