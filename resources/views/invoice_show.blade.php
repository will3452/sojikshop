<x-layout>
    <style>
        @media print {
            #navbar,#printbutton {
                display: none;
            }

        }
    </style>
    <div style="max-width: 210mm;" class="mx-auto">
        <div class="flex mt-4 text-xs">
            <div class="w-1/2 border p-2 mr-2">
                <div class="font-bold uppercase">
                    Invoice For
                </div>
                <div>
                    {{$invoice->user->name}}
                </div>
            </div>
            <div class="w-1/2 border p-2">
                <div class="font-bold uppercase">
                    Transaction #
                </div>
                <div>
                    {{$invoice->txnid}}
                </div>
                <div class="font-bold uppercase mt-4">
                    Date
                </div>
                <div>
                    {{$invoice->created_at->format('m/d/Y')}}
                </div>
            </div>
        </div>
        <table class="w-full mt-2 text-left border p-2 text-sm">
            <thead>
                <tr>
                    <th class="text-purple-900 border p-1 mx-2">
                        Description
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Quantity
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Unit Price
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Total Price
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($invoice->items)->products as $item)
                <tr>
                    <td class="border p-1 mx-2">
                        {{$item->name}}
                    </td>
                    <td class="border p-1 mx-2">
                        {{$item->quantity}}
                    </td>
                    <td class="border p-1 mx-2">
                        {{$item->price}}
                    </td>
                    <td class="border p-1 mx-2">
                        {{$item->price * $item->quantity}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th colspan="2" class="border">
                        Shipping
                    </th>
                    <th class="border">
                        {{json_decode($invoice->items)->summary->shipping_fee}}
                    </th>
                </tr>
                <tr>
                    <th></th>

                    <th colspan="2" class="border">
                        Total
                    </th>
                    <th class="border">
                        {{json_decode($invoice->items)->summary->total}}
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th colspan="2" class="border">
                        Grand Total
                    </th>
                    <th class="border">
                        {{json_decode($invoice->items)->summary->grand_total}}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-2">
        <button id="printbutton" class="px-4 py-2 font-bold rounded bg-green-200 uppercase text-sm" onclick="window.print()" >print</button>
    </div>
</x-layout>
