<?php

namespace App\Nova;

use App\Models\BuyingRequest as ModelsBuyingRequest;
use App\Nova\Actions\MarkAsFound;
use App\Nova\Actions\MarkAsNotFound;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BuyingRequest extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\BuyingRequest::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

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
                ->sortable(),

            BelongsTo::make('Customer', 'user'),

            Text::make('status', function($request){
                if($request->status == ModelsBuyingRequest::STATUS_PENDING){
                    return "<span class='px-4 py-2 rounded-3xl bg-gray-300 text-gray-900 uppercase font-black text-xs'>Pending</span>";
                }

                if($request->status == ModelsBuyingRequest::STATUS_FOUND){
                    return "<span class='px-4 py-2 rounded-3xl bg-green-300 text-green-900 uppercase font-black text-xs'>Found</span>";
                }

                if($request->status == ModelsBuyingRequest::STATUS_NOT_FOUND){
                    return "<span class='px-4 py-2 rounded-3xl bg-red-300 text-red-900 uppercase font-black text-xs'>Not Found</span>";
                }
            })->asHtml()
            ->exceptOnForms(),

            Text::make('Customer Details', function($request){

                $customer = json_decode($request->customer_details);
                return "
                <ul>
                    <li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'>Name <span>$customer->name</span></li>
                    <li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'>Email <span>$customer->email</span></li>
                    <li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'>Mobile No. <span>$customer->mobile   </span></li>
                </ul>
                ";
            })->asHtml()
            ->hideFromIndex(),

            Text::make('Item Details', function($request){

                $item_details = json_decode($request->product_details);
                $itemImage = explode('/', $item_details->image);
                $itemImage = '/storage/'.end($itemImage);
                return "
                <ul>
                    <li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'>Name <span>$item_details->name</span></li>
                    <li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'>Description <span>$item_details->description</span></li>
                    <li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'>Quantity <span>$item_details->quantity</span></li>
                    <li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'>Image <a  target='_blank'  href='$itemImage' class='bg-blue-300 uppercase font-bold text-blue-900 rounded text-xs px-2 py-2' >View</a></li>
                </ul>
                ";
            })->asHtml()
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
            MarkAsFound::make()
                ->onlyOnDetail(),

            MarkAsNotFound::make()
                ->onlyOnDetail()
        ];
    }
}
