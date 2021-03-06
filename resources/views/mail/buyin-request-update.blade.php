@component('mail::message')
# Buying Request Update

Status : {{$buyingRequest->status}}

@if ($buyingRequest->quotation != null)
    Quotation: {{$buyingRequest->quotation}}

    Cost per Item: {{$buyingRequest->item_price}}
@endif

{{$message}}

@component('mail::button', ['url' => url('/')])
Go to Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
