<?php

namespace App\Nova\Actions;

use App\Mail\BuyingRequestUpdate;
use App\Models\BuyingRequest;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Fields\Textarea;

class MarkAsFound extends Action
{
    use InteractsWithQueue, Queueable;

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
            if ($model->status == BuyingRequest::STATUS_FOUND) {
                continue;
            }

            $model->update([
                'quotation'=>$fields->quotation,
                'unit_cost'=>$fields->item_price,
                'status'=>BuyingRequest::STATUS_FOUND
            ]);

            //send email
            $email = json_decode($model->customer_details)->email;
            Mail::to($email)
                ->send(new BuyingRequestUpdate($model, $fields->message));
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
            Text::make('Quotation')
                ->rules('required'),

            Text::make('Item Price')
                ->rules('required'),

            Textarea::make('Message')
                ->rules(['required'])
        ];
    }
}
