@props([
    'title',
    'text' => '',
    'value1' => null,
    'value2' => null,
    'color' => 'blue',
    'textColor' => null,
    'bgColor' => null,
])

@php
    $bg = $bgColor ?? 'bg-' . $color . '-100';
    $textC = $textColor ?? 'text-' . $color . '-800';
@endphp

<div class="{{ $bgColor }} p-4 rounded shadow">
    <h3 class="font-bold {{ $textColor }} mb-2">{{ $title }}</h3>
    <p>{!! $text !!}</p>
    @if($value1 !== null || $value2 !== null)
        <div class="mt-2">
            @if($value1 !== null)
                <span class="font-semibold">{{ $value1 }}</span>
            @endif
            @if($value2 !== null)
                <span class="font-semibold ml-2">{{ $value2 }}</span>
            @endif
        </div>
    @endif
</div> 