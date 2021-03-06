<?php

namespace App\Nova;

use App\Models\Area;
use Laravel\Nova\Fields\ID;
use App\Nova\Filters\Status;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use App\Models\Order as ModelsOrder;
use App\Nova\Actions\MarkAsDelivery;
use App\Nova\Actions\MarkAsPackaging;
use App\Nova\Actions\MarkAsReceived;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Order extends Resource
{
    public static $group = "Order Management";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return "$this->reference_number - $this->status";
    }


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
        'reference_number',
        'items',
        'status'
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
                ->sortable()
                ->exceptOnForms(),

            BelongsTo::make('User', 'user', User::class),

            Text::make('reference_number')
                ->exceptOnForms(),

            Text::make('Items', function ($order) {
                $list = "<ul>";
                foreach (json_decode($order->items)->products as $item) {
                    $product = $item->quantity. 'x - '.$item->name . ' - PHP' . ($item->price * $item->quantity);
                    $list .= "<li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'><img class='w-10 h-10 rounded-full shadow border-2 border-blue-100' src='/storage/$item->image' />$product</li>";
                }
                return $list. '</ul>';
            })
                ->asHtml()
                ->exceptOnForms()
                ->hideFromIndex(),

            Text::make('Location', function ($order) {
                $location = json_decode($order->location);
                $text = "
                <p> Address : <span class='px-2 text-sm font-bold bg-green-200 text-gray-900 rounded-3xl'>$location->shipping_inline_address</span></p>
                <p>Zip Code : <span class='px-2 text-sm font-bold bg-green-200 text-gray-900 rounded-3xl'>$location->shipping_postal_code</span></p>
                <p>Shipping Street: <span class='px-2 text-sm font-bold bg-green-200 text-gray-900 rounded-3xl'>$location->shipping_street</span></p>
                <p>Shipping barangay: <span class='px-2 text-sm font-bold bg-green-200 text-gray-900 rounded-3xl'>$location->shipping_barangay</span></p>
                <p>Shipping city: <span class='px-2 text-sm font-bold bg-green-200 text-gray-900 rounded-3xl'>$location->shipping_city</span></p>
                <p>Shipping Subdivision/bldg: <span class='px-2 text-sm font-bold bg-green-200 text-gray-900 rounded-3xl'>$location->shipping_building</span></p>
                <p>Shipping House/Flr Number: <span class='px-2 text-sm font-bold bg-green-200 text-gray-900 rounded-3xl'>$location->shipping_house_number</span></p>";

                return "<div class='leading-7' >$text</div>";
            })
                ->asHtml()
                ->exceptOnForms()
                ->hideFromIndex(),

            Text::make('Status', function ($order) {
                if ($order->status == ModelsOrder::STATUS_PRE_ORDER) {
                    return "<span class='px-4 py-2 rounded-3xl bg-gray-300 text-gray-900 uppercase font-black text-xs'>Pre-Order</span>";
                }

                if ($order->status == ModelsOrder::STATUS_PACKAGING) {
                    return "<span class='px-4 py-2 rounded-3xl bg-blue-300 text-blue-900 uppercase font-black text-xs'>Packaging</span>";
                }

                if ($order->status == ModelsOrder::STATUS_DELIVERY) {
                    return "<span class='px-4 py-2 rounded-3xl bg-yellow-300 text-yellow-900 uppercase font-black text-xs'>Shipped</span>";
                }

                if ($order->status == ModelsOrder::STATUS_FEEDBACK) {
                    return "<span class='px-4 py-2 rounded-3xl bg-gray-300 text-blue-900 uppercase font-black text-xs'>Received</span>";
                }

                if ($order->status == ModelsOrder::STATUS_COMPLETED) {
                    return "<span class='px-4 py-2 rounded-3xl bg-green-300 text-black uppercase font-black text-xs'>Completed</span>";
                }

                if ($order->status == ModelsOrder::STATUS_RETURN) {
                    return "<span class='px-4 py-2 rounded-3xl bg-red-300 text-red-900 uppercase font-black text-xs'>Return</span>";
                }
            })
                ->asHtml()
                ->exceptOnForms(),

            Text::make('Amount', function ($order) {
                $amount = json_decode($order->invoice->items)->summary->grand_total;
                return "<span class='px-4 py-2 rounded bg-yellow-300 text-yellow-900 text-2xl uppercase font-black'><span class='text-sm' >PHP</span>$amount</span>";
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
        return [
            Status::make(),
        ];
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
            MarkAsPackaging::make(),

            MarkAsDelivery::make(),

            MarkAsReceived::make(),
        ];
    }
}
