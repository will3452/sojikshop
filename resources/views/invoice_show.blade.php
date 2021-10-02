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
                {{-- <button class="block text-center" onclick="savePaymentDetails()">
                    <span class="material-icons">
                    save_alt
                    </span>
                </button> --}}
            </div>
            <div class="p-2 text-xs text-gray-800" id="payment_details">
                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Transaction #
                    </div>
                    <div>
                        {{$invoice->txn_id}}
                    </div>
                </div>

                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Payer Email
                    </div>
                    <div>
                        {{$invoice->payer_email}}
                    </div>
                </div>

                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Payer Name
                    </div>
                    <div>
                        {{$invoice->payer_first_name}} {{$invoice->payer_last_name}}
                    </div>
                </div>

                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Payment Type
                    </div>
                    <div>
                        {{$invoice->payment_type}} (Paypal)
                    </div>
                </div>

                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Shipping Fee
                    </div>
                    <div>
                        PHP {{$invoice->shipping}}
                    </div>
                </div>

                <div class="flex justify-between  pb-2">
                    <div class="font-bold">
                        Payment Gross
                    </div>
                    <div>
                        PHP {{$invoice->payment_gross}}
                    </div>
                </div>

                <div class="flex justify-between">
                    <div class="font-bold">
                        Payment Created At
                    </div>
                    <div>
                        {{$invoice->payment_created_at}}
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
                        Number of Order Items
                    </div>
                    <div>
                        {{$invoice->num_cart_items}}
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
