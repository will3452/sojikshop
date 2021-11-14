<x-layout>
    <x-title>
        Return Order
    </x-title>
    <div class="p-2 flex justify-center">
        <form action="{{url()->current()}}" method="POST" class="mx-auto w-full shadow  rounded p-4 md:w-4/12" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Order Reference Number *</label>
                <input
                type="text" readonly value="{{$order->reference_number}}"
                class="w-full p-2 border-2 border-pink-600 rounded uppercase">
            </div>
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Valid Reason *</label>
                <textarea
                type="text"
                required
                name="reason"
                maxlength="200"
                class="w-full p-2 border-2 border-pink-600 rounded"></textarea>
            </div>
            <div class="mb-4">
                <label for="" class="block font-bold text-sm text-gray-900 uppercase mb-4">Attach Photo (optional)</label>
                <input type="file" name="attachment" required accept="image/*">
            </div>
            <div>
                <button class="p-2 bg-purple-900 text-white font-bold rounded w-full">
                    SUBMIT
                </button>
            </div>
        </form>
    </div>
</x-layout>
