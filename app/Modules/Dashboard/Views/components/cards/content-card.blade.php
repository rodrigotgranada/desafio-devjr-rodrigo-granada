@props(['task'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col h-full">
    <div class="p-6 flex flex-col h-full">
        <div class="flex-1">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-lg font-semibold">
                        <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-800">
                            
                            {{ Str::limit($task->title, 20) }}
                        </a>
                    </h2>
                    <p class="text-xs text-gray-500">Criado: {{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y H:i') }}</p>
                    <p class="text-xs text-gray-500">Prazo: {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y H:i') }}</p>
                    @if($task->completed && $task->completed_at)
                        <p class="text-xs text-green-700">Concluída em: {{ \Carbon\Carbon::parse($task->completed_at)->format('d/m/Y H:i') }}</p>
                    @endif
                </div>
                <x-status-badge :completed="$task->completed" :due-date="$task->due_date" />
            </div>
            
            <p class="mt-2 text-gray-600">{{ Str::limit($task->description, 100) }}</p>
        </div>
        <div class="mt-4 flex gap-2 justify-end" x-data="{ showDeleteModal{{ $task->id }}: false }">
            <x-primary-button
                :href="route('tasks.toggle', $task)"
                method="PATCH"
                :bgColor="$task->completed ? 'bg-green-600' : 'bg-blue-600'"
                :hoverBgColor="$task->completed ? 'hover:bg-green-700' : 'hover:bg-blue-700'"
                textColor="text-white"
                title="{{ $task->completed ? 'Desfazer' : 'Concluir' }}"
            >
                @if($task->completed)
                    @include('components.icons.undo')
                @else
                    @include('components.icons.check')
                @endif
            </x-primary-button>

            <x-primary-button
                :href="route('tasks.edit', $task)"
                method="GET"
                bgColor="bg-yellow-500"
                hoverBgColor="hover:bg-yellow-600"
                textColor="text-white"
                title="Editar"
            >
                @include('components.icons.edit')
            </x-primary-button>

            <x-primary-button
                type="button"
                bgColor="bg-red-600"
                hoverBgColor="hover:bg-red-700"
                textColor="text-white"
                title="Excluir"
                @click="showDeleteModal{{ $task->id }} = true"
            >
                @include('components.icons.trash')
            </x-primary-button>
            <x-confirm-modal
                :action="route('tasks.destroy', $task)"
                method="DELETE"
                message="Tem certeza que deseja excluir a tarefa '{{ $task->title }}'?"
                confirmText="Excluir"
                cancelText="Cancelar"
                :xShow="'showDeleteModal' . $task->id"
            />
        </div>
    </div>
</div>
