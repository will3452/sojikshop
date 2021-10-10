<x-layout>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js">
    </script>
    <x-title>
        Invoice
    </x-title>
    <div class="px-2 md:w-1/2 mx-auto">
        <div class="w-full mx-auto shadow rounded-lg overflow-hidden">
            <div class="p-2 bg-purple-900 text-white flex justify-between items-center">
                Payment Details
            </div>
            <div class="p-2 text-xs text-gray-800" id="payment_details">
                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Transaction #
                    </div>
                    <div>
                        {{$invoice->txnid}}
                    </div>
                </div>

                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Payer
                    </div>
                    <div>
                        {{auth()->user()->name}}
                    </div>
                </div>

                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Total Amount
                    </div>
                    <div>
                        PHP {{$invoice->amount}}
                    </div>
                </div>

                <div class="flex justify-between">
                    <div class="font-bold">
                        Created At
                    </div>
                    <div>
                        {{$invoice->created_at}}
                    </div>
                </div>
            </div>

        </div>
        <div class="w-full mx-auto shadow rounded-lg overflow-hidden mt-2">
            <div class="p-2 bg-purple-900 text-white">
                Order Details
            </div>
            <div class="p-2 text-xs text-gray-800">
                <div class="flex justify-between ">
                    <div class="font-bold">
                        Reference Number
                    </div>
                    <div>
                        {{$invoice->order->reference_number}}
                    </div>
                </div>
            </div>
            <div class="p-2 text-xs text-gray-800">
                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        No. of items
                    </div>
                    <div>
                        {{$invoice->number_of_items}}
                    </div>
                </div>
            </div>
            <div class="p-2 text-xs text-gray-800">
                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Items
                    </div>
                    <div>
                        <ul>
                            @foreach (json_decode($invoice->items) as $item)
                                <li>
                                    - {{$item->product_name}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <a id="image-save-here" class="hidden" download>
    </a>

     <script>
        function savePaymentDetails(){
            html2canvas(document.getElementById('payment_details')).then(function(canvas) {
                let dataUrl = canvas.toDataURL("image/png");
                document.getElementById('image-save-here').download = 'invoice-{{$invoice->txn_id}}.png';
                document.getElementById('image-save-here').href = dataUrl.replace("image/png", "image/octet-stream");
                document.getElementById('image-save-here').click();
            });
        }
     </script>
</x-layout>
