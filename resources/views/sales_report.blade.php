<x-layout>

    <style>
        @media print {
            #navbar,#printbutton {
                display: none;
            }

        }
    </style>
    <div style="max-width: 210mm;" class="mx-auto">
        <table class="w-full mt-2 text-left border p-2 text-sm" id="myTable">
            <thead>
                <tr>
                    <th class="text-purple-900 border p-1 mx-2">
                        Line #
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Reference Number
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Items
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Total Cost
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Date (mm/dd/yy)
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            {{$count++}}
                        </td>
                        <td>
                            {{$order->reference_number}}
                        </td>
                        <td>
                            @php
                                $names = [];

                                foreach(json_decode($order->items)->products as $p){
                                    $names[] = $p->name;
                                }
                            @endphp
                            {{implode(', ', $names)}}
                        </td>
                        <td>
                            {{json_decode($order->items)->summary->grand_total}}
                        </td>
                        <td>
                            {{$order->created_at->format('m/d/y')}}
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center mt-2">
        <button id="printbutton" class="px-4 py-2 font-bold rounded bg-green-200 uppercase text-sm" onclick="window.print()" >print</button>
    </div>


</x-layout>
