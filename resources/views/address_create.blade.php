<x-layout>
    <x-title>Add Address</x-title>
    <form action="/add-new-address" method="POST" class="w-1/2 mx-auto">
        @csrf
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                Street *
            </label>
            <input type="text" value="" name="street" required   class="mt-2 w-full p-2 rounded border-2 border-pink-600">
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                Postal Code *
            </label>
            <input type="number" value="" name="postal_code" required   class="mt-2 w-full p-2 rounded border-2 border-pink-600">
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                Barangay *
            </label>
            <input type="text" value="" name="barangay" required   class="mt-2 w-full p-2 rounded border-2 border-pink-600">
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                City *
            </label>
            <input type="text" value="" name="city" required   class="mt-2 w-full p-2 rounded border-2 border-pink-600">
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                Region
            </label>
            <select name="region" required id="" class="mt-2 w-full p-2 rounded border-2 border-pink-600">
                <option value="NCR">NCR</option>
                <option value="CAR">CAR</option>
                <option value="Region I">Region I</option>
                <option value="Region II">Region II</option>
                <option value="Region III">Region III</option>
                <option value="Region IV-A">Region IV-A</option>
                <option value="Mimaropa">Mimaropa</option>
                <option value="Region V">Region V</option>
                <option value="Region VI">Region VI</option>
                <option value="RRegion VII">Region VII</option>
                <option value="Region VIII">Region VIII</option>
                <option value="Region IX">Region IX</option>
                <option value="Region X">Region X</option>
                <option value="Region XI">Region XI</option>
                <option value="Region XII">Region XII</option>
                <option value="Region XIII">Region XIII</option>
                <option value="BARMM">BARMM</option>
            </select>
        </div>

        <button class="p-2 text-sm text-white bg-pink-500 rounded px-4 uppercase font-bold">Add</button>

    </form>
</x-layout>
