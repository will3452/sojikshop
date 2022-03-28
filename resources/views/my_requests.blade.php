<x-layout>
    </script>
    <x-datatable>
        <input type="hidden" id="">
        <div class="md:w-2/3 w-full mx-auto">
            <x-title>
                My Buying Requests
            </x-title>
            <div class="w-full overflow-auto">
                <table class=" text-center" id="myTable">
                    <thead>
                        <tr>
                            <th class="border border-black bg-blue-800">
                                Date
                            </th>
                            <th class="border border-black bg-blue-800">
                                Product Details
                            </th>
                            <th class="border border-black bg-blue-800">
                                Quotation
                            </th>
                            <th class="border border-black bg-blue-800">
                                Status
                            </th>
                            <th class="border border-black bg-blue-800">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->buyingRequests as $item)
                            <tr x-data="{
                                modalisopen:false,
                            }">
                                <template x-if="modalisopen">
                                    <div class="fixed w-screen h-screen bg-green-100 top-0 bottom-0 left-0 right-0 z-40 flex justify-center items-center">
                                        <div class="bg-white shadow-lg p-4 rounded w-full md:w-1/2 relative">
                                            <button x-on:click="modalisopen = false" class="transform block absolute -top-2 -right-2 rotate-45 font-bold bg-red-300 w-10 h-10 rounded-full text-xl">+</button>
                                            <div class="mt-2">
                                                <div class="uppercase font-bold text-left">
                                                    Item Description:
                                                </div>
                                                <div class="text-left">
                                                    {{json_decode($item->product_details)->name}}
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <div class="uppercase font-bold text-left">
                                                    Quantity:
                                                </div>
                                                <div class="text-left">
                                                    {{json_decode($item->product_details)->quantity}}
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <div class="uppercase font-bold text-left">
                                                    Quotation :
                                                </div>
                                                <div class="text-left">
                                                    {{$item->quotation}}
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <div class="uppercase font-bold text-left">
                                                    Cost per Item :
                                                </div>
                                                <div class="text-left">
                                                    {{$item->unit_cost}}
                                                </div>
                                            </div>
                                            <div>
                                                <a href="/buying-request-checkout/{{$item->id}}">Proceed to Pay</a>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <td class="border border-black">
                                    {{$item->created_at->format('m/d/Y')}}
                                </td>
                                <td class="border border-black">
                                    {{json_decode($item->product_details)->name}}
                                </td>
                                <td class="border border-black">
                                    {{$item->quotation ?? 'N/a'}}
                                </td>
                                <td class="border border-black">
                                    {{$item->status}}
                                </td>
                                <td class="border border-black text-center">
                                    @if ($item->status == \App\Models\BuyingRequest::STATUS_NOT_FOUND || $item->status == \App\Models\BuyingRequest::STATUS_PENDING)
                                        <a>--</a>
                                    @else
                                        @if ($item->status != \App\Models\BuyingRequest::STATUS_PAID)
                                            <button x-on:click="modalisopen = true" class="p-2 py-1  text-sm font-bold rounded bg-green-100">
                                                View To Pay
                                            </button>
                                        @else
                                            <a href="/buying-receipt/{{$item->id}}" class="underline">View Reciept</a>
                                        @endif
                                    @endif
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
        </div>
    </x-datatable>
</x-layout>
