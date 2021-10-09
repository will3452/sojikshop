@props(['carts'=>[], 'shipping'=>0, 'total'=>0, 'totalVat'=>0])
<div class="text-sm mx-2 shadow-lg rounded overflow-hidden mx-auto md:w-2/3">
    <div class="p-2 bg-purple-900 text-white font-bold uppercase">
        Order Information
    </div>
    <div class="p-2">
        <table class="w-full border-2">
            <thead class="bg-green-100">
                <tr>
                    <th class="py-2 uppercase">
                        Item
                    </th>
                    <th class="py-2 uppercase">
                        Price
                    </th>
                    <th class="py-2 uppercase">
                        Shipping Fee
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <td class="p-2">
                            <span class="font-bold">{{$cart->quantity}}x</span> -
                            {{$cart->product->name}}
                        </td>
                        <td>
                            PHP {{number_format($cart->product->price * $cart->quantity, 2)}}
                        </td>
                        <td>
                            PHP {{number_format($cart->product->shipping_fee * $cart->quantity, 2)}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-2 bg-yellow-200 rounded my-2">
            {{nova_get_setting('checkout_vat_note') ?? 'The VAT is already included in the total.'}}
        </div>
        <table class="w-full border-2 mt-2">
            <tr class="text-left">
                <th class="p-2 border-2">
                    VAT
                </th>
                <td class="p-2 border-2">
                    {{nova_get_setting('vat') ?? '12'}}%
                </td>
            </tr>
            <tr class="text-left">
                <th class="p-2 border-2">
                    Total
                </th>
                <td class="p-2 border-2">
                    PHP {{ $total != null ? number_format($total, 2):'XXXX' }}
                </td>
            </tr>
        </table>
        <div class="flex justify-between mt-2 items-center">
            <a href="{{url()->previous()}}" class="p-2 px-5 rounded font-bold bg-purple-900 text-white">
                BACK
            </a>
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                {{-- cart information --}}
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="upload" value="1">
                {{-- set currencty --}}
                <input type="hidden" name="currency_code" value="PHP">
                {{-- business name --}}
                <input type="hidden" name="business" value="sojikshop@business.example.com">

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
                <input type="hidden" name="shipping" value="{{$shipping}}">
                <input type="hidden" name="shipping" value="{{$shipping}}">
                {{-- <input type="hidden" name="shipping_1" value="2"> --}}
                {{-- <input type="hidden" name="shipping_2" value="2.50"> --}}

                {{-- methods and return url --}}
                <input type="hidden" name="rm" value="2">
                <input type="hidden" NAME="return"
                value="{{url('/api/payment-success')}}?uid={{auth()->id()}}">
                <input type="hidden" name="cancel_return" value="{{url('/api/payment-cancelled')}}">

                {{-- webhook  --}}
                {{-- <input type="hidden" name="notify_url" value="{{url('/api/posts')}}"> --}}

                <input type="hidden" name="tax_cart" value="{{$totalVat}}">

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
                <input type="hidden" name="callback_url" value="{{url('api/paypal-callback')}}">
                <input type="hidden" name="callback_timeout" value="3">
                <input type="hidden" name="callback_version" value="1">
                <input type="hidden" name="fallback_shipping_option_name_0" value="1">
                <input type="hidden" name="fallback_shipping_option_amount_0"  value="0">
                <input type="hidden" name="fallback_shipping_option_is_default_0" value="1">

                {{-- button --}}
                <input type="submit" value="Pay With Paypal" class="uppercase font-bold cursor-pointer rounded px-4 p-2 m-3 bg-green-500 text-white text-xs">
            </form>
        </div>
    </div>


</div>
