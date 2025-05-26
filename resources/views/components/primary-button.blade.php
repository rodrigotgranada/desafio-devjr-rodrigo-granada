@props([
    'href' => null,
    'type' => 'submit',
    'method' => 'GET',
    'bgColor' => 'bg-indigo-600',
    'hoverBgColor' => 'hover:bg-indigo-700',
    'textColor' => 'text-white',
    'class' => '',
    'label' => null,
    'onclick' => null,
    'title' => null,
])

@php
    $baseClasses = "inline-flex items-center px-4 py-2 $bgColor border border-transparent rounded-md font-semibold text-xs $textColor uppercase tracking-widest $hoverBgColor $class";
@endphp

@if($href && strtoupper($method) === 'GET')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses, 'onclick' => $onclick, 'title' => $title]) }}>
        @if(isset($slot) && ((is_object($slot) && !$slot->isEmpty()) || (is_string($slot) && trim($slot) !== '')))
            {{ $slot }}
        @else
            {{ $label ?? 'Botão' }}
        @endif
    </a>
@elseif(!$href)
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses, 'onclick' => $onclick, 'title' => $title]) }}>
        @if(isset($slot) && ((is_object($slot) && !$slot->isEmpty()) || (is_string($slot) && trim($slot) !== '')))
            {{ $slot }}
        @else
            {{ $label ?? 'Botão' }}
        @endif
    </button>
@else
    <form action="{{ $href }}" method="POST" class="inline">
        @csrf
        @if(strtoupper($method) !== 'POST')
            @method($method)
        @endif
        <button type="{{ $type }}" class="{{ $baseClasses }}" @if($onclick) onclick="{{ $onclick }}" @endif @if($title) title="{{ $title }}" @endif>
            @if(isset($slot) && ((is_object($slot) && !$slot->isEmpty()) || (is_string($slot) && trim($slot) !== '')))
                {{ $slot }}
            @else
                {{ $label ?? 'Botão' }}
            @endif
        </button>
    </form>
@endif 