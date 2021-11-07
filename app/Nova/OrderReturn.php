<?php

namespace App\Nova;

use App\Nova\Actions\WriteMessage;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderReturn extends Resource
{
    public static function label()
    {
        return "Returns";
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public static $group = "Order Management";

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ReturnReason::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference_number';

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
            Date::make('Date', 'created_at')
                ->exceptOnForms(),
            HasOne::make('user'),
            Text::make('Order Reference #', function () {
                return $this->order->reference_number ?? '---';
            })->exceptOnForms(),
            HasOne::make('order'),
            Image::make('Attachment', function () {
                $array = explode('/', $this->attachment);

                return end($array);
            }),
            Textarea::make('Reason')
                ->alwaysShow()
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
        return [
            WriteMessage::make(),
        ];
    }
}
