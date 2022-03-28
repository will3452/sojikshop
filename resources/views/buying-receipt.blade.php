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
                    Receipt For
                </div>
                <div>
                    {{auth()->user()->name}}
                </div>
                <div>
                    {{auth()->user()->mobile}}
                </div>
            </div>
            <div class="w-1/2 border p-2">
                <div class="font-bold uppercase">
                    Transaction #
                </div>
                <div>
                    BR{{\Str::padLeft($buyingRequest->id, 8, '0')}}
                </div>
                <div class="font-bold uppercase mt-4">
                    Date
                </div>
                <div>
                    {{$buyingRequest->updated_at->format('m/d/Y')}}
                </div>
            </div>
        </div>
        <table class="w-full mt-2 text-left border p-2 text-sm" id="myTable">
            <thead>
                <tr>
                    <th class="text-blue-900 border p-1 mx-2">
                        Description
                    </th>
                    <th class="text-blue-900 border p-1 mx-2">
                        Quantity
                    </th>
                    <th class="text-blue-900 border p-1 mx-2">
                        Unit Price
                    </th>
                    <th class="text-blue-900 border p-1 mx-2">
                        Total Price
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-1 mx-2">
                        {{json_decode($buyingRequest->product_details)->name}}
                    </td>
                    <td class="border p-1 mx-2">
                        {{json_decode($buyingRequest->product_details)->quantity}}
                    </td>
                    <td class="border p-1 mx-2">
                        {{$buyingRequest->unit_cost}}
                    </td>
                    <td class="border p-1 mx-2">
                        {{$buyingRequest->unit_cost * json_decode($buyingRequest->product_details)->quantity}}
                    </td>
                </tr>
                <tr>
                    <th class="border">
                        {{$buyingRequest->unit_cost * json_decode($buyingRequest->product_details)->quantity}}
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th colspan="2" class="border">
                        Grand Total
                    </th>
                    <th class="border">
                        {{$buyingRequest->unit_cost * json_decode($buyingRequest->product_details)->quantity}}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-2">
        <button id="printbutton" class="px-4 py-2 font-bold rounded bg-blue-800 uppercase text-sm" onclick="window.print()" >print</button>
    </div>


</x-layout>
