<?php

namespace App\Nova\Actions;

use App\Models\Order;
use App\Models\Courier;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MarkAsDelivery extends Action
{
    use InteractsWithQueue, Queueable;

    public function name()
    {
        return 'Mark As Shipped';
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            if ($model->status == Order::STATUS_DELIVERY) {
                continue;
            }

            if (!is_null($fields['courier_id'])) {
                if (is_null($fields['tracking_number'])) {
                    return Action::danger('No Tracking Number!');
                }

                $model->delivery()->create([
                    'courier_id'=>$fields['courier_id'],
                    'tracking_number'=>$fields['tracking_number']
                ]);
            }

            $model->update([
                'status'=>Order::STATUS_DELIVERY
            ]);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Courier', 'courier_id')
                ->rules('required')
                ->options(Courier::get()->pluck('name', 'id')),
            Text::make('Tracking Number'),
        ];
    }
}
