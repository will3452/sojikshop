<x-layout>
    <x-title>
        @php
            $text = explode('_', $page);
            $text = implode(' ', $text);
        @endphp
        {{$text}}
    </x-title>
    <div class="mx-auto w-full md:w-1/2">
        {!!nova_get_setting($page)!!}
    </div>
</x-layout>
