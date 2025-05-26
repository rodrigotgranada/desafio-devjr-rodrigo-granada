@props([
    'title' => null,
    'created_at' => null,
    'completed_at' => null,
])

@php
    $minDate = '2000-01-01';
    $maxDate = '2099-12-31';
    $filtros = [
        'title' => request('title'),
        'created_at' => request('created_at'),
        'completed_at' => request('completed_at'),
    ];
    $filtrosAtivos = collect($filtros)->filter(fn($v) => !empty($v))->count();
@endphp

<div class="relative">
    <button type="button" onclick="toggleDropdown('filterDropdown')" class="p-2 bg-gray-200 rounded hover:bg-gray-300 relative" aria-label="Abrir filtros">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0013 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 017 17v-3.586a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z" />
        </svg>
        @if($filtrosAtivos > 0)
            <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-blue-500 rounded-full">
                {{ $filtrosAtivos }}
            </span>
        @endif
    </button>
    <div id="filterDropdown" class="hidden absolute w-60 z-10 mt-2 bg-white border rounded shadow-lg p-4 min-w-[250px]">
        <div class="flex justify-between items-center mb-2">
            <span class="font-semibold text-gray-700">Filtros</span>
            <button type="button" onclick="toggleDropdown('filterDropdown')" class="text-gray-400 hover:text-gray-700" aria-label="Fechar filtros">&times;</button>
        </div>
        <form method="GET" class="flex flex-col gap-2">
            <label class="text-xs">Título
                <input type="text" name="title" value="{{ $title ?? request('title') }}" class="border border-gray-300 rounded px-2 py-1 w-full focus:border-indigo-500 focus:ring-0" maxlength="100" placeholder="Digite o título">
            </label>
            <label class="text-xs">Data de Criação
                <input type="date" name="created_at" value="{{ $created_at ?? request('created_at') }}" class="border border-gray-300 rounded px-2 py-1 w-full focus:border-indigo-500 focus:ring-0"
                    min="{{ $minDate }}" max="{{ $maxDate }}">
            </label>
            <label class="text-xs">Data de Conclusão
                <input type="date" name="completed_at" value="{{ $completed_at ?? request('completed_at') }}" class="border border-gray-300 rounded px-2 py-1 w-full focus:border-indigo-500 focus:ring-0"
                    min="{{ $minDate }}" max="{{ $maxDate }}">
            </label>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 hover:bg-blue-600 transition">Filtrar</button>
        </form>
        <div class="flex justify-end">
            <a href="{{ url()->current() }}" class="text-xs text-gray-500 hover:text-red-600 underline mt-1">Limpar filtros</a>
        </div>
    </div>
</div> 