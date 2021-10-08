<x-layout>
    <x-title>
        CHECKOUT
    </x-title>
    @if ($step == 0)
        <x-checkout-shipping-set area="{{$area}}" address="{{$address}}"></x-checkout-shipping-set>
    @else
        <x-checkout-shipping-products :carts="$carts"></x-checkout-shipping-products>
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
</x-layout>
