<x-layout>
    <x-title>
        Pre-Order
    </x-title>
    <div class="justify-center flex flex-col items-center">
        <img src="/storage/{{$product->image}}" class="w-60 h-60" alt="">
        <div class="mx-2">
            <h1 class="font-bold">
                {{$product->name}}
            </h1>
            <form action="/preorder-pay" class="mt-2">
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <label for="" class="block mb-2 font-bold text-gray-900 text-sm">Enter The quantity</label>
                <input type="number" min="1" value="1" name="quantity" class="w-full border-2 border-pink-600 p-2 rounded">
                <button type="submit"
                class="bg-pink-600 text-white font-bold mt-2 p-2 text-center w-full rounded-3xl">
                    PAY NOW
                </button>
            </form>
        </div>
    </div>
</x-layout>
