<x-layout>
    <x-datatable>
        <x-title>
            My Pre-Orders
        </x-title>
        <div class="w-2/3 mx-auto w-screen overflow-auto">
            <table class="text-center" id="myTable">
                <thead>
                    <tr>
                        <th class="border border-black bg-blue-800">
                            Date
                        </th>
                        <th class="border border-black bg-blue-800">
                            Ref #
                        </th>
                        <th class="border border-black bg-blue-800">
                            Product
                        </th>
                        <th class="border border-black bg-blue-800">
                            Price
                        </th>
                        <th class="border border-black bg-blue-800">
                            Quantity
                        </th>
                        <th class="border border-black bg-blue-800">
                            Total
                        </th>
                        <th class="border border-black bg-blue-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preOrders as $item)
                        <tr >
                            <td class="border border-black">
                                {{$item->created_at->format('m/d/y')}}
                            </td>
                            <td class="border border-black">
                                {{$item->reference_number}}
                            </td>
                            <td class="border border-black">
                                {{json_decode($item->items)->products[0]->name}}
                            </td>
                            <td class="border border-black">
                                {{json_decode($item->items)->products[0]->price}}
                            </td>
                            <td class="border border-black">
                                {{json_decode($item->items)->products[0]->quantity}}
                            </td>
                            <td class="border border-black">
                                {{number_format(json_decode($item->items)->summary->total, 2)}}
                            </td>
                            <td class="border border-black">
                                <a
                                href="{{url('invoices', ['invoice'=>$item->invoice_id])}}"
                                class="text-xs uppercase bg-blue-200 p-1 px-2 font-bold rounded">
                                    Receipt
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>
    </x-datatable>
</x-layout>
