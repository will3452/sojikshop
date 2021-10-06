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
                    <input type="hidden" name="shipping_{{$index}}" value="{{$cart->product->shipping_fee}}">
                    @endforeach
                    {{-- shipping info --}}

                    {{-- <input type="hidden" name="shipping_2" value="2.50"> --}}

                    {{-- methods and return url --}}
                    <input type="hidden" name="rm" value="2">
                    <input type="hidden" NAME="return" value="{{url('/api/payment-success')}}">
                    <input type="hidden" name="cancel_return" value="{{url('/api/payment-cancelled')}}">

                    {{-- webhook  --}}
                    {{-- <input type="hidden" name="notify_url" value="{{url('/api/posts')}}"> --}}

                    <input type="hidden" name="tax_cart" value="{{$vat ?? 0}}">

                    {{-- callback --}}
                    <input type="hidden" name="callback_url" value="{{url('api/paypal-callback')}}">
                    <input type="hidden" name="callback_timeout" value="3">
                    <input type="hiden" name="callback_version" value="1">
                    <input type="hiden" name="fallback_shipping_option_name_0">
                    <input type="hiden" name="fallback_shipping_option_amount_0">
                    <input type="hidden" name="fallback_shipping_option_is_default_0" value="0">

                    {{-- button --}}
                    <input type="submit" value="Check Out With Paypal" class="cursor-pointer rounded-lg px-4 py-2 m-3 bg-green-500 text-white text-xs">
                </form>
