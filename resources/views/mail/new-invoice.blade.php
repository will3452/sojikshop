@component('mail::message')
# Your Invoice Details:
Transaction # : {{$invoice->txnid}}

Payer Name : {{$user->name}}

Amount: {{$invoice->amount}}

Purchased Item/s:
@foreach (json_decode($invoice->items) as $item)
- {{$item->product_name}}
@endforeach


@component('mail::button', ['url' => url('/')])
Go to {{ config('app.name') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
