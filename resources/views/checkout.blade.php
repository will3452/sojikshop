<x-layout>
    <x-title>
        CHECKOUT
    </x-title>
    <div class="hidden h-screen w-screen bg-gradient-to-r from-pink-600 to-purple-900 fixed top-0 z-50 flex flex-col justify-center items-center"
    style="z-index:90000 !important;"
    id="backdrop">
        <img src="/storage/{{nova_get_setting('logo')}}" alt="" class="w-32 h-32 animate-bounce rounded-full shadow">
        <p class="uppercase text-white font-bold tracking-widest">
            Loading, Please Wait
        </p>
    </div>
    @if ($step == 0)
        <x-checkout-shipping-set area="{{$area}}" address="{{$address}}"></x-checkout-shipping-set>
    @else
        @if (!request()->quantity)
            <x-checkout-shipping-products :totalVat="$totalVat" :carts="$carts" :total="$total" :shipping="$shipping"></x-checkout-shipping-products>
        @else
        <x-checkout-pre-order :totalVat="$totalVat" :product="$product" :total="$total" :shipping="$shipping"></x-checkout-pre-order>
        @endif
    @endif



    <script>
            const long = document.getElementById('long');
            const lat = document.getElementById('lat');

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(({coords})=>{
                        long.value = coords.longitude;
                        lat.value = coords.latitude;

                        reverseGeocoding(coords);

                    });
                } else {
                    console.log('geolocation not supported!');
                }
            }

            function reverseGeocoding({latitude, longitude}){
                fetch(`http://open.mapquestapi.com/geocoding/v1/reverse?key=YCFvPJOH6YxnFQkpOhJ9fMzNIDd6oeMv&location=${latitude},${longitude}`)
                    .then(response=>response.json())
                    .then(({results})=>{
                        let result = results[0];
                        let location = result.locations[0];
                        let street = location.street;
                        let city = location.adminArea3;
                        let barangay = location.adminArea5;
                        let currentAddress = `${street}, ${barangay} ${city}`;
                        console.log(location)
                        document.getElementById('address').value = currentAddress;
                    })
            }


    </script>

<script src="https://www.paypal.com/sdk/js?client-id={{nova_get_setting('paypal_client_id')}}&currency=PHP&disable-card=amex,jcb&locale=en_PH">
</script>

<script>
    let backdrop = document.getElementById('backdrop');
    paypal.Buttons({
        createOrder: function(data, actions){
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{$total}}',
                        currency:'PHP'
                    }
                }]
            })
        },
        onApprove: function(data, actions){
            backdrop.classList.remove('hidden');
            return actions.order.capture().then(function({status, id }){

                let payload = {
                    id: id,
                    status: status,
                    amount: '{{$total}}',
                    shipping_address: '{{request()->address}}',
                    shipping_zip: '{{request()->zip}}',
                    shipping_area_id: '{{request()->area}}',
                    user_id: {{auth()->id()}},
                    lat: '{{request()->lat}}',
                    lng:'{{request()->lng}}',
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
                        window.location.href="{{url('/my-orders')}}";
                    });
            })
        }
    }).render('#paypal-button-container');
</script>

</x-layout>
