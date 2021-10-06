<x-layout>
    <x-title>
        checkout
    </x-title>
    <div class="md:w-1/2 mx-auto shadow">
        <div class="bg-purple-900 text-white text-left text-sm p-2 font-thin text-sm">
            Shipping Address
        </div>
        <div class="w-11/12 mx-auto">
            <div class="mx-auto w-full">
                <input type="text"
                name=""
                placeholder="Shipping Address"
                class="w-full my-2 p-2 bg-yellow-100"
                value="{{request()->shippingaddress??auth()->user()->address}}">
            </div>
            <div class="mx-auto w-full">
                <select name="" id=""
                class="w-full my-2 p-2 bg-yellow-100"
                >
                @foreach ($areas as $area)
                    <option value="{{$area->Code}}">{{$area->description}} - {{$area->code}}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="p-2 md:w-1/2 mx-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-purple-900 text-white text-left text-sm">
                    <th class="p-2 font-thin text-sm">
                        Name
                    </th>
                    <th class="p-2 font-thin text-sm">
                        Quantity
                    </th>
                    <th class="p-2 font-thin text-sm">
                        Price
                    </th>
                    <th class="p-2 font-thin text-sm">
                        Shipping Fee
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $item)
                    <tr>
                        <td class="text-gray-700 text-xs p-2 border-2">
                            {{$item->product->name}}
                        </td>
                        <td class="text-gray-700 text-xs p-2 border-2">
                            {{$item->quantity}}
                        </td>
                        <td class="text-gray-700 text-xs p-2 border-2">
                            PHP {{$item->product->price}}
                        </td>
                        <td class="text-gray-700 text-xs p-2 border-2">
                            PHP {{$item->product->shipping_fee}}
                        </td>
                    </tr>
                @endforeach
                <tr class="h-2">
                </tr>
                <tr>
                    <td class="border-2 p-2 text-xs text-gray-700 border-top-red-100">
                        Shipping Fee
                    </td>
                    <td colspan="3" class="border-2 p-2 text-xs text-gray-700 border-top-red-100">
                        <span class="text-xs">PHP</span> {{number_format(0, 2)}}
                    </td>
                </tr>
                <tr>
                    <td class="border-2 p-2 text-xs text-gray-700 border-top-red-100">
                        VAT
                    </td>
                    <td colspan="3" class="border-2 p-2 text-xs text-gray-700 border-top-red-100">
                        {{nova_get_setting('vat') ?? '1.2%'}}
                    </td>
                </tr>
                <tr class="text-gray-500 border-2">
                    <td colspan="1" class="p-2 font-bold text-gray-900 uppercase">
                        Total Cost
                    </td>
                    <td class="p-2 font-bold text-gray-900" colspan="2">
                        <span class="text-xs">PHP</span> {{number_format($totalCost, 2)}}
                    </td>
                </tr>
            </tbody>
        </table>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            {{-- cart information --}}
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="upload" value="1">
            {{-- set currencty --}}
            <input type="hidden" name="currency_code" value="PHP">
            {{-- business name --}}
            <input type="hidden" name="business" value="sb-f0lsu6671778@business.example.com">

            {{-- product info --}}
            @foreach ($carts as $key=>$cart)
            @php
                $index = $key + 1;
            @endphp
            <input type="hidden" name="item_name_{{$index}}" value="{{$cart->product->name}}">
            <input type="hidden" name="quantity_{{$index}}" value="{{$cart->quantity}}">
            <input type="hidden" name="amount_{{$index}}" value="{{$cart->product->price}}">
            <input type="hidden" name="shipping_{{$index}}" value="{{$cart->product->shippig_fee}}">
            @endforeach
            {{-- shipping info --}}
            {{-- <input type="hidden" name="shipping_1" value="2"> --}}
            {{-- <input type="hidden" name="shipping_2" value="2.50"> --}}

            {{-- methods and return url --}}
            <input type="hidden" name="rm" value="2">
            <input type="hidden" NAME="return"
            value="{{url('/api/payment-success)}}?uid={{auth()->id()}}">
            <input type="hidden" name="cancel_return" value="{{url('/api/payment-cancelled')}}">

            {{-- webhook  --}}
            {{-- <input type="hidden" name="notify_url" value="{{url('/api/posts')}}"> --}}

            <input type="hidden" name="tax_cart" value="{{nova_get_setting('vat') ?? 0}}">

            {{-- callback --}}
            <input type="hidden" name="callback_url" value="{{url('api/paypal-callback')}}">
            <input type="hidden" name="callback_timeout" value="3">
            <input type="hidden" name="callback_version" value="1">
            <input type="hidden" name="fallback_shipping_option_name_0" value="1">
            <input type="hidden" name="fallback_shipping_option_amount_0"  value="0">
            <input type="hidden" name="fallback_shipping_option_is_default_0" value="1">

            {{-- button --}}
            <div class="flex justify-between items-center">
                <a href="/my-cart" class="cursor-pointer rounded-lg px-4 py-2 m-3 bg-gray-900 text-white text-xs">Back To Your Cart</a>
                <input type="submit" value="Pay With Paypal" class="font-bold cursor-pointer rounded-lg px-4 py-2 m-3 bg-green-500 text-white text-xs">
            </div>
        </form>
    </div>

    <script>
        let returnUrl = "";
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position){
                    returnUrl = `{{url('/api/payment-success)}}?uid={{auth()->id()}}&lat=${position.coords.latitude}&lon=${position.coords.longitude}`;
                });
            } else {
                console.log("can't get location!");
            }
        }

        getLocation();

    </script>


</x-layout>
