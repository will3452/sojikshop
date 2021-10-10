@props(['area'=>null, 'address'=>null])

<div>
    <div class="text-sm mx-2 shadow-lg rounded overflow-hidden mx-auto md:w-2/3">
        <div class="p-2 bg-purple-900 text-white font-bold uppercase">
            Shipping Address
        </div>
        <div class="p-2">
            <form action="{{url()->current()}}" method="GET">
                <input type="hidden" name="lat" value="" id="lat">
                <input type="hidden" name="lng" value="" id="long">
                <div class="w-full px-2 mb-2">
                    <label for="">Address 1</label>
                    <div class="flex items-center mt-2">
                        <input type="hidden" name="step" value="1">
                        <input type="text"
                        id="address"
                        required
                        class="w-11/12 p-2 border-2 border-pink-500"
                        name="address"
                        value="{{$address ?? auth()->user()->address}}">
                        <button type="button" onclick="getLocation()" class="w-1/12 bg-pink-600 p-1 border-2 border-pink-600" >
                            <span class="material-icons text-white">
                            my_location
                            </span>
                        </button>
                    </div>
                </div>
                <div class="w-full px-2 mb-2 flex">
                    <div class="w-4/12">
                        <label for="">Zip Code</label>
                        <input type="text" required name="zip" class="w-11/12 p-2 border-2 border-pink-500">
                    </div>
                    <div class="w-4/12">
                        <label for="">State</label>
                        <input type="text" required name="state" class="w-11/12 p-2 border-2 border-pink-500">
                    </div>
                    <div class="w-4/12">
                        <label for="">City</label>
                        <input type="text" required name="city" class="w-11/12 p-2 border-2 border-pink-500">
                    </div>
                </div>
                <div class="w-full px-2 mb-2">
                    <label for="">Shipping Area</label>
                    <select name="area"
                    required
                    class="w-full p-2 border-2 border-pink-500 mt-2"
                    >
                        @foreach (\App\Models\Area::get() as $xarea)
                            <option {{$area != $xarea->id?:'selected'}} value="{{$xarea->id}}">{{$xarea->code}} - {{$xarea->description}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button class="w-full p-2 text-center rounded rounded-lg uppercase text-gray-900 font-bold bg-gray-300">
                        SAVE AND CONTINUE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
