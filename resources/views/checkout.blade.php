<x-layout>
    <x-title>
        Invoice
    </x-title>
    <div class="hidden h-screen w-screen bg-gradient-to-r from-pink-600 to-purple-900 fixed top-0 z-50 flex flex-col justify-center items-center"
    style="z-index:90000 !important;"
    id="backdrop">
        <img src="/storage/{{nova_get_setting('logo')}}" alt="" class="w-32 h-32 animate-bounce rounded-full shadow">
        <p class="uppercase text-white font-bold tracking-widest">
            Loading, Please Wait
        </p>
    </div>

    @if (auth()->user()->addresses()->count())
        <div class="text-sm mx-2 shadow-lg rounded overflow-hidden mx-auto md:w-10/12 mb-2">
            <div class="p-2 bg-purple-900 text-white font-bold uppercase flex justify-between">
                <div>
                    Address
                </div>
                <a href="/add-new-address" class="text-white text-xs p-1 bg-pink-500 rounded">
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
        @if (!request()->quantity)
            <x-checkout-shipping-products :carts="$carts" :shipping="$shipping" :total="$total"></x-checkout-shipping-products>
        @else
            <x-checkout-pre-order  :product="$product" :total="$total" ></x-checkout-pre-order>
        @endif
    @else
    <div class="bg-red-100 text-center p-2">
        Please Add Address to your Profile, for you to checkout.
    </div>
    @endif


<script src="https://www.paypal.com/sdk/js?client-id={{nova_get_setting('paypal_client_id')}}&currency=PHP&disable-funding=credit,card&disable-card=amex,jcb&locale=en_PH">
</script>

<script>
    let backdrop = document.getElementById('backdrop');
    paypal.Buttons({
        createOrder: function(data, actions){
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{$total + $shipping}}',
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
                    id: id,
                    typeOfOrder:"{{$isPreOrder ? \App\Models\Order::STATUS_PRE_ORDER:\App\Models\Order::STATUS_PACKAGING}}",
                    status: status,
                    shipping_fee:'{{$shipping}}',
                    amount: '{{$total}}',
                    shipping_inline_address: '{{$address->inline_address}}',
                    shipping_postal_code: '{{$address->postal_code}}',
                    shipping_street:'{{$address->street}}',
                    shipping_barangay:'{{$address->barangay}}',
                    shipping_city:'{{$address->city}}',
                    shipping_building:'{{$address->building}}',
                    shipping_house_number:'{{$address->house_number}}',
                    user_id: {{auth()->id()}},
                    @if(request()->has('quantity') && request()->has('product_id'))
                        order_status:'{{\App\Models\Order::STATUS_PRE_ORDER}}',
                        product_id:{{request()->product_id}},
                        quantity:{{request()->quantity}},
                    @endif
                };
                //save the transaction to the server using post
                fetch('/api/create-order', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload)})
                    .then(data=>data.json())
                    .then(function(data){
                        @if((request()->has('quantity') && request()->has('product_id')) || $isPreOrder)
                            window.location.href="{{url('/my-pre-orders')}}";
                        @else
                            window.location.href="{{url('/my-orders')}}";
                        @endif
                    });
            })
        }
    }).render('#paypal-button-container');
</script>

</x-layout>
