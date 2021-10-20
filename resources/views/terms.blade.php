<x-layout>
    <x-title>
        Terms and Conditions
    </x-title>
    <div class="w-1/2 mx-auto">
        {!!nova_get_setting('terms_and_conditions') ?? ''!!}
    </div>
</x-layout>
