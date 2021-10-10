@props(['shipping'=>0, 'product'=>[],'total'=>0, 'totalVat'=>0])
<div class="mb-4 mx-auto md:w-2/3">
    <a href="{{url()->previous()}}" class="p-2 px-5 rounded font-bold bg-gray-900 text-white">
        BACK
    </a>
</div>
<div class="text-sm mx-2 shadow-lg rounded overflow-hidden mx-auto md:w-2/3">
    <div class="p-2 bg-purple-900 text-white font-bold uppercase">
        Pre-Order Information
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
                <tr>
                    <td class="p-2">
                        <span class="font-bold">{{request()->quantity}}x</span> -
                        {{$product->name}}
                    </td>
                    <td>
                        PHP {{number_format($product->price * request()->quantity, 2)}}
                    </td>
                    <td>
                        PHP {{number_format($product->shipping_fee * request()->quantity, 2)}}
                    </td>
                </tr>
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
        <div class="flex justify-center mt-2 items-center">
            {{-- <x-pay-with-paypal-html></x-pay-with-paypal-html> --}}
            <div id="paypal-button-container">
            </div>
        </div>
    </div>
</div>
