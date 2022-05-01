@props(['name'])
<input
{{ $attributes->merge([
    'name'=>$name,
    'class'=>'mt-4 border-2 border-pink-500 w-full p-2 placeholder-pink-300'
]) }}
value="{{ old($name) ?? '' }}"
>
@error($name)
    <div class="text-xs text-red-600">
        {{ $message }}
    </div>
@enderror
