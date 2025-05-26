@props([
    'type' => 'text',
    'name',
    'id' => null,
    'value' => '',
    'placeholder' => '',
    'class' => ''
])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'appearance-none py-1 px-2 border-0 border-b border-gray-300 focus:border-indigo-500 focus:ring-0 rounded-none w-full ' . $class]) }}
/> 