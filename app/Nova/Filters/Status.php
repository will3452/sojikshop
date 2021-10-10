<?php

namespace App\Nova\Filters;

use App\Models\Order;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class Status extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->whereStatus($value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            Order::STATUS_PACKAGING=>Order::STATUS_PACKAGING,
            Order::STATUS_DELIVERY=>Order::STATUS_DELIVERY,
            'completed'=>Order::STATUS_FEEDBACK,
        ];
    }
}
