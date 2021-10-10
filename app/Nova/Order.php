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
use App\Nova\Actions\MarkAsRereived;
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
    public function title(){
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

            Text::make('reference_number')
                ->exceptOnForms(),

            Text::make('Items', function($order){
                $list = "<ul>";
                foreach(json_decode($order->items) as $item){
                    $product = $item->quantity. 'x - '.$item->product_name;
                    $list .= "<li class='p-2 rounded px-4 mb-2 shadow flex justify-between items-center'><img class='w-10 h-10 rounded-full shadow border-2 border-purple-100' src='/storage/$item->product_image' />$product</li>";
                }
                return $list. '</ul>';
            })
                ->asHtml()
                ->exceptOnForms()
                ->hideFromIndex(),

            Text::make('Location', function($order){
                $location = json_decode($order->location);
                $shippingArea = Area::find($location->shipping_area_id);
                $text = "
                <p> Address : <span class='px-2 text-sm font-bold bg-green-100 text-green-900 rounded-3xl'>$location->shipping_address</span></p>
                <p>Zip Code : <span class='px-2 text-sm font-bold bg-green-100 text-green-900 rounded-3xl'>$location->shipping_zip</span></p>
                <p>Shipping Area: <span class='px-2 text-sm font-bold bg-green-100 text-green-900 rounded-3xl'>$shippingArea->description</span></p>
                <p>Coordinates : <span class='px-2 text-sm font-bold bg-green-100 text-green-900 rounded-3xl'>$location->lat, $location->lng</span></p>
                ".'<div style="width: 100%" class="p-4 shadow rounded" ><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q='.$location->lat.','.$location->lng.'+(Sojikshop)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>';

                return "<div class='leading-7' >$text</div>";
            })
                ->asHtml()
                ->exceptOnForms()
                ->hideFromIndex(),

            Text::make('Status', function($order){
                if($order->status == ModelsOrder::STATUS_PACKAGING){
                    return "<span class='px-4 py-2 rounded-3xl bg-blue-300 text-blue-900 uppercase font-black text-xs'>Packaging</span>";
                }

                if($order->status == ModelsOrder::STATUS_DELIVERY){
                    return "<span class='px-4 py-2 rounded-3xl bg-yellow-300 text-yellow-900 uppercase font-black text-xs'>Delivery</span>";
                }

                if($order->status == ModelsOrder::STATUS_FEEDBACK){
                    return "<span class='px-4 py-2 rounded-3xl bg-green-300 text-green-900 uppercase font-black text-xs'>Completed</span>";
                }
            })
                ->asHtml()
                ->exceptOnForms(),

            Text::make('Amount', function($order){
                $amount = $order->invoice->amount;
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
            MarkAsDelivery::make(),

            MarkAsRereived::make(),

            new DownloadExcel(),
        ];
    }
}
