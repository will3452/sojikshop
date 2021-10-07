<x-layout>
    <x-title>
        CHECKOUT
    </x-title>
    <x-checkout-shipping-set area="{{$area}}" address="{{$address}}"></x-checkout-shipping-set>

    <script>
            const long = document.getElementById('long');
            const lat = document.getElementById('lat');

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(({coords})=>{
                        long.value = coords.longitude;
                        lat.value = coords.latitude;
                        alert('current location found!');
                    });
                } else {
                    console.log('geolocation not supported!');
                }
            }
            getLocation();
    </script>
</x-layout>
