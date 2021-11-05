<x-layout>
    <x-title>
        Data Privacy
    </x-title>
    <div class="w-1/2 mx-auto">
        {!!nova_get_setting('data_privacy') ?? ''!!}
    </div>
</x-layout>
