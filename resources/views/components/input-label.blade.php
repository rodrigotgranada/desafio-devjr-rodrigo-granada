@props(['for' => null, 'value' => null])

<label @if($for) for="{{ $for }}" @endif class="block text-sm font-medium text-gray-700 mb-1">
    {{ $value ?? $slot }}
</label> 