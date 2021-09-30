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
                    @endforeach
                    {{-- shipping info --}}
                    <input type="hidden" name="shipping_1" value="100.00">
                    {{-- <input type="hidden" name="shipping_2" value="2.50"> --}}

                    {{-- methods and return url --}}
                    <input type="hidden" name="rm" value="2">
                    <input type="hidden" NAME="return" value="{{url('/api/payment-success')}}">
                    <input type="hidden" name="cancel_return" value="{{url('/api/payment-cancelled')}}">

                    {{-- webhook  --}}
                    {{-- <input type="hidden" name="notify_url" value="{{url('/api/posts')}}"> --}}

                    {{-- custom fields || meta --}}
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">

                    {{-- button --}}
                    <input type="submit" value="Check Out With Paypal" class="cursor-pointer rounded-lg px-4 py-2 m-3 bg-green-500 text-white text-xs">
                </form>
