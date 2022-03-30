<x-layout>
    <x-title>
        Pay Buying Request
    </x-title>
    <div class="hidden h-screen w-screen bg-gradient-to-r from-pink-600 to-blue-900 fixed top-0 z-50 flex flex-col justify-center items-center"
    style="z-index:90000 !important;"
    id="backdrop">
        <img src="/storage/{{nova_get_setting('logo')}}" alt="" class="w-32 h-32 animate-bounce rounded-full shadow">
        <p class="uppercase text-blue-900 font-bold tracking-widest">
            Loading, Please Wait
        </p>
    </div>

    @if (auth()->user()->addresses()->count())
        <div class="text-sm mx-2 shadow-lg rounded overflow-hidden mx-auto md:w-10/12 mb-2">
            <div class="p-2 bg-blue-900 text-white font-bold uppercase flex justify-between">
                <div>
                    Address
                </div>
                <a href="/add-new-address" class="text-blue-900 text-xs p-1 bg-blue-200 rounded">
                    Add Address
                </a>
            </div>
            <div class="p-2">
                <form action="{{url()->current()}}">
                    <select name="address_id" id="" class="w-full" onchange="this.parentNode.submit()">
                        @foreach (auth()->user()->addresses as $address)
                            <option value="{{$address->id}}" {{request()->address_id ? (request()->address_id != $address->id ?:'selected'):(!$address->is_default ?:'selected')}}>
                                {{$address->inline_address}}
                            </option>
                        @endforeach
                    </select>
            </form>
            </div>
        </div>
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
                            <tr>
                                <td class="p-2">
                                    {{json_decode($buyingRequest->product_details)->quantity}}
                                </td>
                                <td class="p-2">
                                    {{json_decode($buyingRequest->product_details)->name}}
                                </td>
                                <td>
                                    PHP {{$buyingRequest->unit_cost * json_decode($buyingRequest->product_details)->quantity}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="p-2 bg-blue-200 rounded my-2">
                        {{nova_get_setting('checkout_vat_note') ?? 'The VAT is already included in the total.'}}
                    </div>
                    <table class="w-full border-2 mt-2">
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
                                PHP {{ $total != null ? number_format($total):'XXXX' }}
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
    @else
    <div class="bg-red-100 text-center p-2">
        Please Add Address to your Profile, for you to checkout.
    </div>
    @endif


<script src="https://www.paypal.com/sdk/js?client-id={{nova_get_setting('paypal_client_id')}}&currency=PHP&disable-card=amex,jcb&locale=en_PH">
</script>

<script>
    let backdrop = document.getElementById('backdrop');
    paypal.Buttons({
        createOrder: function(data, actions){
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: {{$total}} + 1,
                        currency:'PHP'
                    }
                }],
                application_context: {
                    shipping_preference:'NO_SHIPPING',
                    brand_name:'{{config('app.name')}}'
                }

            })
        },
        onApprove: function(data, actions){
            backdrop.classList.remove('hidden');
            return actions.order.capture().then(function({status, id }){
                let payload = {
                    'buying_request_id' : {{$buyingRequest->id}}
                };
                //save the transaction to the server using post
                fetch('/api/buying-paid', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload)})
                    .then(data=>data.json())
                    .then(function(data){
                        window.location.href="{{url('/my-requets')}}";
                    });
            })
        }
    }).render('#paypal-button-container');
</script>

</x-layout>
