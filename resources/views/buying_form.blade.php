<x-layout>
    <x-title>
        Buying Request Form
    </x-title>
    <div class="p-2 flex justify-center">
        <form action="{{url()->current()}}" method="POST" class="mx-auto w-full shadow  rounded p-4 md:w-4/12" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Name *</label>
                <input
                @auth
                    value="{{auth()->user()->name}}"
                @endauth
                type="text" name="name" required placeholder="Juan DeLa Cruz" class="w-full p-2 border-2 border-pink-600 rounded">
            </div>
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Email *</label>
                <input
                @auth
                    value="{{auth()->user()->email}}"
                @endauth
                type="email" name="email" required placeholder="juan@mail.com" class="w-full p-2 border-2 border-pink-600 rounded">
            </div>
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Mobile No. *</label>
                <input
                @auth
                    value="{{auth()->user()->mobile}}"
                @endauth
                type="text" name="mobile" required  class="w-full p-2 border-2 border-pink-600 rounded">
            </div>
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Item Name *</label>
                <input type="text" name="item_name" required placeholder="" class="w-full p-2 border-2 border-pink-600 rounded">
            </div>
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Item Quantity *</label>
                <input type="text" name="item_quantity" required placeholder="" class="w-full p-2 border-2 border-pink-600 rounded">
            </div>
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Item Description </label>
                <textarea name="item_description" required id="" placeholder="Sizes, Colors, and etc..," class="w-full p-2 border-2 border-pink-600 rounded"></textarea>
            </div>
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Item Picture </label>
                <input  required type="file" accept="image/*" name="item_image">
            </div>

            <button class="px-4 py-2 bg-blue-900 text-blue-900 uppercase rounded-3xl w-full text-center font-bold">
                Submit
            </button>

        </form>
    </div>
</x-layout>
