@props(['completed', 'dueDate'])

@php
    $isLate = !$completed && \Carbon\Carbon::parse($dueDate)->isPast();
    $color = $completed
        ? 'bg-green-100 text-green-800'
        : ($isLate
            ? 'bg-red-100 text-red-800'
            : 'bg-yellow-100 text-yellow-800');
    $label = $completed
        ? 'Concluída'
        : ($isLate
            ? 'Atrasada'
            : 'Pendente');
@endphp

<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
    {{ $label }}
</span> 