<x-layout>
    <x-title>Add Address</x-title>
    <form
    action="/add-new-address"
    method="POST"
    class="w-1/2 mx-auto"
    x-data="
    {
        regions:[],
        cities:[],
        selectedRegion:'x|x',
        selectedCity:'x|x',
        getSelectedCode(str){
            return str.split('|')[0];
        },
        getSelectedName(str){
            return str.split('|')[1];
        },
        getCities(){
            fetch(`https://psgc.gitlab.io/api/regions/${this.getSelectedCode(this.selectedRegion)}/cities.json`)
                .then(res=>res.json())
                .then(res=>{
                   this.cities = res;
                })
        },
        onchangeRegion(e){
            this.getCities();
            this.selecedCity = 'x|x';
        }
    }"
    x-init="
        fetch('https://psgc.gitlab.io/api/regions.json')
            .then(res=>res.json())
            .then(res=>{
                regions = res;
            })
    ">
        @csrf
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                Region
            </label>
            <input type="hidden" name="region" x-bind:value="getSelectedName(selectedRegion)">
            <select x-model="selectedRegion" x-on:change="onchangeRegion" required id="" class="mt-2 w-full p-2 rounded border-2 border-pink-600">
                <option value="">----</option>
                <template x-for="region in regions">
                    <option x-bind:value="`${region.code}|${region.name}`" x-text="`${region.name} - ${region.regionName}`"></option>
                </template>
            </select>
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                City *
            </label>
            <input type="hidden" name="city" x-bind:value="getSelectedName(selectedCity)">
            <select x-model="selectedCity" x-on:change="onchangeCity" required id="" class="mt-2 w-full p-2 rounded border-2 border-pink-600">
                <option value="">----</option>
                <template x-for="city in cities">
                    <option x-bind:value="`${city.code}|${city.name}`" x-text="city.name"></option>
                </template>
            </select>
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                Barangay *
            </label>
            <input type="text" value="" name="barangay" required   class="mt-2 w-full p-2 rounded border-2 border-pink-600">
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
               Zip Code *
            </label>
            <input type="number" value="" name="postal_code" required   class="mt-2 w-full p-2 rounded border-2 border-pink-600">
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                Subdivision/bldg *
            </label>
            <input type="text" value="" name="building" required   class="mt-2 w-full p-2 rounded border-2 border-pink-600">
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                Street *
            </label>
            <input type="text" value="" name="street" required   class="mt-2 w-full p-2 rounded border-2 border-pink-600">
        </div>
        <div class="mb-4">
            <label for="" class="block font-bold text-sm text-gray-900">
                House/Flr Number *
            </label>
            <input type="text" value="" name="house_number" required   class="mt-2 w-full p-2 rounded border-2 border-pink-600">
        </div>

        <button class="p-2 text-sm text-blue-900 bg-green-200 rounded px-4 uppercase font-bold">Add</button>

    </form>
</x-layout>
