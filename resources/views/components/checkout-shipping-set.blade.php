@props(['area', 'address'])

<div>
    <div class="text-sm mx-2 shadow-lg rounded overflow-hidden">
        <div class="p-2 bg-purple-900 text-white font-bold uppercase">
            Shipping Address
        </div>
        <div class="p-2">
            <form action="{{url()->current()}}" method="GET">
                <input type="hidden" name="lat" value="" id="lat">
                <input type="hidden" name="long" value="" id="long">
                <div class="w-full px-2 mb-2">
                    <label for="">Address</label>
                    <input type="text"
                    id="address"
                    required
                    class="w-full p-2 border-2 border-pink-500 mt-2"
                    name="address"
                    value="{{$address ?? auth()->user()->address}}">
                </div>
                <div class="w-full px-2 mb-2">
                    <label for="">Area</label>
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
