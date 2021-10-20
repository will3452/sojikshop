<x-layout>
    <x-title>
        My Buying Requests
    </x-title>
    <table class="w-2/3 mx-auto text-center">
        <thead>
            <tr>
                <th class="border border-black bg-green-200">
                    Date
                </th>
                <th class="border border-black bg-green-200">
                    Product Details
                </th>
                <th class="border border-black bg-green-200">
                    Quotation
                </th>
                <th class="border border-black bg-green-200">
                    Status
                </th>
                <th class="border border-black bg-green-200">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach (auth()->user()->buyingRequests as $item)
                <tr>
                    <td class="border border-black">
                        {{$item->created_at->format('m/d/Y')}}
                    </td>
                    <td class="border border-black">
                        {{json_decode($item->product_details)->name}}
                    </td>
                    <td class="border border-black">
                        {{$item->quotation ?? 'N/a'}}
                    </td>
                    <td class="border border-black">
                        {{$item->status}}
                    </td>
                    <td class="border border-black text-center">
                        <button onclick="alert('under development')" class="p-2 py-1  text-sm font-bold rounded bg-pink-300">
                            View
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
