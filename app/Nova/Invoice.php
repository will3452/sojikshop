<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Invoice extends Resource
{
    public static $group = "Order Management";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Invoice::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title(){
        return "$this->txnid - $this->amount";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'txnid',
        'user_id',
        'amount',
        'items'
    ];

    public function authorizedToUpdate(Request $request)
    {
        if($request->has('action')){
            return true;
        }
        return false;
    }

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
                ->exceptOnForms()
                ->sortable(),

            Text::make('Transaction #', 'txnid')
                ->rules(['required', 'unique:invoices,txnid']),

            BelongsTo::make('User'),

            Text::make('Amount')
                ->rules(['required', 'numeric']),

            Text::make('Items', function($invoice){
                $list = "<ul>";
                foreach(json_decode($invoice->items) as $item){
                    $product = $item->quantity. 'x - '.$item->product_name;
                    $list .= "<li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'><img class='w-10 h-10 rounded-full shadow border-2 border-purple-100' src='/storage/$item->product_image' />$product</li>";
                }
                return $list. '</ul>';
            })
                ->asHtml()
                ->exceptOnForms()
                ->hideFromIndex(),
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
            new DownloadExcel(),
        ];
    }
}
