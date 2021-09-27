<x-layout>
    <ul>
        @foreach ($carts as $item)
            <li>
                {{ $item->product->name }}
            </li>
        @endforeach
    </ul>
</x-layout>