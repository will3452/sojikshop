<x-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <x-title>
        TRACKING PAGE
    </x-title>
    <form action="" class="flex md:w-1/2 w-11/12 mx-auto">
        <input type="search" name="tracking_number" value="{{request()->tracking_number}}" class="border-2 border-blue-700 w-full p-2" placeholder="Enter Tracking number here">

    </form>


    @if (!$order)
        <div class="text-center text-red-600 font-bold">
            Please Enter Valid Tracking Number
        </div>
    @else
    <div id="map" style="height:180px;" class="w-11/12 md:w-1/2 mx-auto mt-2">
    </div>
    @endif


    <script>
        @if($order)
            var mymap = L.map('map').setView([{{$order->lat}}, {{$order->lng}}], 19);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(mymap);

                L.marker([{{$order->lat}}, {{$order->lng}}]).addTo(mymap);
        @endif


    </script>
</x-layout>
