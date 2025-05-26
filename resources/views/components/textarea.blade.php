@props([
    'name',
    'id' => null,
    'rows' => 3,
    'value' => '',
    'required' => false,
    'class' => '',
])

<textarea
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    rows="{{ $rows }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge(['class' => "py-1 px-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 $class"]) }}
>{{ trim($slot) !== '' ? $slot : old($name, $value) }}</textarea> 