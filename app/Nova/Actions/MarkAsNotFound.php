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

class MarkAsNotFound extends Action
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
            if ($model->status == BuyingRequest::STATUS_NOT_FOUND) {
                continue;
            }

            $model->update([
                'status'=>BuyingRequest::STATUS_NOT_FOUND
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

            Textarea::make('Message')
                ->rules(['required'])
        ];
    }
}
