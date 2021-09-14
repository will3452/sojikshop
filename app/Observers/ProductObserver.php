<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    public function created(Product $p)
    {
        $p->update([
            'reference_number' => "P-" . Str::padLeft($p->id, 5, '0'),
        ]);
    }
}
