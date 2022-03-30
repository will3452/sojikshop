@props(['carts'=>[], 'total'=>0, 'shipping'=>0])
<div class="text-sm mx-2 shadow-lg rounded overflow-hidden mx-auto md:w-10/12">
    <div class="p-2 bg-blue-900 text-white font-bold uppercase">
        Order Information
    </div>
    <div class="p-2 md:flex">
        <div class="md:w-2/3">
            <table class="w-full border-2">
                <thead class="bg-blue-200">
                    <tr>
                        <th>
                            Quantity
                        </th>
                        <th class="py-2 uppercase">
                            Description
                        </th>
                        <th class="py-2 uppercase">
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <td class="p-2">
                                {{$cart->quantity}}
                            </td>
                            <td class="p-2">
                                {{$cart->product->name}}
                            </td>
                            @if ($cart->product->hasDiscount())
                            <td>
                                PHP {{number_format($cart->product->discounted_price * $cart->quantity, 2)}}
                            </td>
                            @else
                            <td>
                                PHP {{number_format($cart->product->price * $cart->quantity, 2)}}
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-2 bg-blue-200 rounded my-2">
                {{nova_get_setting('checkout_vat_note') ?? 'The VAT is already included in the total.'}}
            </div>
            <table class="w-full border-2 mt-2">
                <tr class="text-left">
                    <th class="p-2 border-2">
                        Shipping
                    </th>
                    <td class="p-2 border-2">
                        {{ $shipping != 0 ? 'PHP '.number_format($shipping):'FREE' }}
                    </td>
                </tr>
                <tr class="text-left">
                    <th class="p-2 border-2">
                        VAT ( {{nova_get_setting('vat') ?? 12}} % )
                    </th>
                    <td class="p-2 border-2">
                        PHP {{$total * ((nova_get_setting('vat') ?? 12)/100)}}
                    </td>
                </tr>
                <tr class="text-left">
                    <th class="p-2 border-2">
                        Total
                    </th>
                    <td class="p-2 border-2">
                        PHP {{ $total != null ? number_format(($total + ($total * ((nova_get_setting('vat') ?? 12)/100))),2):'XXXX' }}
                    </td>
                </tr>
                <tr class="text-left">
                    <th class="p-2 border-2">
                        Grand Total
                    </th>
                    <td class="p-2 border-2">
                        PHP {{ $total != null ? number_format(($total + $shipping + ($total * ((nova_get_setting('vat') ?? 12)/100))),2):'XXXX' }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="p-2 mt-2 items-center w-full md:w-1/2">
            {{-- <x-pay-with-paypal-html></x-pay-with-paypal-html> --}}
            <div id="paypal-button-container">
            </div>
        </div>
    </div>
</div>
