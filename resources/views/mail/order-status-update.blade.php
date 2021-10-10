@component('mail::message')
# Order Update

Hello {{explode(' ', $user->name)[0]}}, Your order with ref#{{$order->reference_number}}
@if ($order->status == App\Models\Order::STATUS_DELIVERY)
    {{nova_get_setting('delivery_mail_message')}}
@elseif($order->status == App\Models\Order::STATUS_FEEDBACK)
    {{nova_get_setting('feedback_mail_message')}}
@elseif($order->status == App\Models\Order::STATUS_PACKAGING)
    {{nova_get_setting('packaging_mail_message')}}
@endif

@component('mail::button', ['url' => url('/')])
Go to Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
