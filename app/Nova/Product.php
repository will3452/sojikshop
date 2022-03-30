<?php

namespace App\Nova;

use Illuminate\Http\Request;
use App\Nova\Lenses\LowStock;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use App\Nova\Lenses\OutOfStock;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsToMany;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Product extends Resource
{

    public static $group = "data Management";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'reference_number',
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
            Text::make('Reference Number')
                ->exceptOnForms()
                ->hideFromIndex(),

            Text::make('Name')
                ->required(),

            Textarea::make('Description')
                ->required(),

            Image::make('image')
                ->hideFromIndex()
                ->required(),

            Number::make('Price')
                ->step(.1)
                ->required(),

            Number::make('Quantity')
                ->required(),

            Boolean::make('Pre-Order', 'is_pre_order'),

            // Number::make('Shipping Fee')
            //     ->hideFromIndex()
            //     ->rules(['required'])
            //     ->step(.1)
            //     ->required(),
            HasMany::make('Shipping Fees', 'shippingFees'),
            BelongsToMany::make('Categories'),
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
        return [
            OutOfStock::make(),
            LowStock::make(),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new DownloadExcel(),
        ];
    }
}
