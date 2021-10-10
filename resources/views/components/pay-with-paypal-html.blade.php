{{-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    {{-- cart information --}}
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    {{-- set currencty --}}
    <input type="hidden" name="currency_code" value="PHP">
    {{-- business name --}}
    <input type="hidden" name="business" value="sojikshop@business.example.com">
    <input type="hidden" name="tax" value="{{number_format($totalVat, 2)}}">
    {{-- product info --}}
    @foreach ($carts as $key=>$cart)
    @php
        $index = $key + 1;
    @endphp
    <input type="hidden" name="item_name_{{$index}}" value="{{$cart->product->name}}">
    <input type="hidden" name="quantity_{{$index}}" value="{{$cart->quantity}}">
    <input type="hidden" name="amount_{{$index}}" value="{{$cart->product->price}}">
    @endforeach
    {{-- shipping info --}}
    <input type="hidden" name="shipping" value="{{number_format($shipping,2)}}">
    {{-- <input type="hidden" name="shipping_2" value="2.50"> --}}

    {{-- methods and return url --}}
    <input type="hidden" name="rm" value="2">
    <input type="hidden" NAME="return"
    value="{{url('/api/payment-success')}}?uid={{auth()->id()}}&lat={{request()->lat}}&lng={{request()->lng}}&area={{request()->area}}">
    <input type="hidden" name="cancel_return" value="{{url()->full()}}">

    {{-- webhook  --}}
    {{-- <input type="hidden" name="notify_url" value="{{url('/api/posts')}}"> --}}



    {{-- buyer creds --}}
    <input type="hidden" name="address_override" value="1">
<!-- Set variables that override the address stored with PayPal. -->

    <input type="hidden" name="first_name" value="{{auth()->user()->first_name}}">

    <input type="hidden" name="last_name" value="{{auth()->user()->last_name}}">

    <input type="hidden" name="address1" value="{{request()->address ?? auth()->user()->address}}">

    <input type="hidden" name="city" value="{{request()->city}}">

    <input type="hidden" name="state" value="{{request()->state}}">

    <input type="hidden" name="zip" value="{{request()->zip}}">

    <input type="hidden" name="country" value="PH">

    {{-- callback --}}
    {{-- <input type="hidden" name="callback_url" value="{{url('api/paypal-callback')}}"> --}}
    {{-- <input type="hidden" name="callback_timeout" value="3">
    <input type="hidden" name="callback_version" value="1">
    <input type="hidden" name="fallback_shipping_option_name_0" value="1">
    <input type="hidden" name="fallback_shipping_option_amount_0"  value="0">
    <input type="hidden" name="fallback_shipping_option_is_default_0" value="1"> --}}

    {{-- button --}}
    <input type="submit" value="Pay With Paypal" class="uppercase font-bold cursor-pointer rounded px-4 p-2 m-3 bg-green-500 text-white text-xs">
</form> --}}
