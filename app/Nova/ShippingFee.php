<?php

namespace App\Nova;

use Laravel\Nova\Nova;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class ShippingFee extends Resource
{
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return  ('/resources/products/'.$resource->product_id);
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return  ('/resources/products/'.$resource->product_id);
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToView(Request $request)
    {
        return false;
    }

    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ShippingFee::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Product')
                ->rules('required'),

            Select::make('Region', 'region_id')
                ->rules(['required'])
                ->options(function () {
                    $product = \App\Models\Product::find(request()->viaResourceId);
                    return \App\Models\Region::whereNotIn('id', $product->shippingFees()->get()->pluck('region_id')->toArray() ?? [])->get()->pluck('name', 'id');
                })->displayUsing(function () {
                    return \App\Models\Region::find($this->region_id)->name;
                }),

                Number::make('Amount per Unit', 'amount')
                ->rules('required'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
