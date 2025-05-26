@props([
    'sort' => null,
    'order' => null,
])

<div class="relative">
    <button type="button" onclick="toggleDropdown('sortDropdown')" class="p-2 bg-gray-200 rounded hover:bg-gray-300" aria-label="Abrir ordenação">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4m0 0V6m0 4l5.5 5.5M21 14h-4m0 0v4m0-4l-5.5-5.5" />
        </svg>
    </button>
    <div id="sortDropdown" class="hidden absolute w-60 z-10 mt-2 bg-white border rounded shadow-lg p-4 min-w-[250px]">
        <div class="flex justify-between items-center mb-2">
            <span class="font-semibold text-gray-700">Ordenação</span>
            <button type="button" onclick="toggleDropdown('sortDropdown')" class="text-gray-400 hover:text-gray-700" aria-label="Fechar ordenação">&times;</button>
        </div>
        <form method="GET" class="flex flex-col gap-2">
            <label class="text-xs">Ordenar por
                <select name="sort" class="border border-gray-300 rounded px-2 py-1 w-full focus:border-indigo-500 focus:ring-0">
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Data de Criação</option>
                    <option value="completed_at" {{ request('sort') == 'completed_at' ? 'selected' : '' }}>Data de Conclusão</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Título</option>
                </select>
            </label>
            <label class="text-xs">Ordem
                <select name="order" class="border border-gray-300 rounded px-2 py-1 w-full focus:border-indigo-500 focus:ring-0">
                    <option value="asc" {{ ($order ?? request('order')) == 'asc' ? 'selected' : '' }}>Crescente</option>
                    <option value="desc" {{ ($order ?? request('order')) == 'desc' ? 'selected' : '' }}>Decrescente</option>
                </select>
            </label>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 hover:bg-blue-600 transition">Ordenar</button>
        </form>
    </div>
</div> 