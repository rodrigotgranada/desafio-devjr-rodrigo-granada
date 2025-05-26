@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold">Editar Tarefa</h2>
        </div>

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-input-label for="title">Título</x-input-label>
                <x-text-input name="title" id="title" :value="old('title', $task->title)" disabled />
                <input type="hidden" name="title" value="{{ $task->title }}">
                <x-error field="title" />
            </div>

            <div class="mb-4">
                <x-input-label for="description">Descrição</x-input-label>
                <x-textarea name="description" id="description" rows="3" required>{{ old('description', $task->description) }}</x-textarea>
                <x-error field="description" />
            </div>

            <div class="mb-4">
                <x-input-label for="due_date">Prazo</x-input-label>
                <x-text-input name="due_date" id="due_date" type="datetime-local" :value="old('due_date', $task->due_date->format('Y-m-d\TH:i'))" required />
                <x-error field="due_date" />
            </div>

            <div class="mb-4">
                <x-input-label>Status</x-input-label>
                <div class="mt-1">
                    <input type="hidden" name="completed" value="0">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="completed" value="1"
                            {{ old('completed', $task->completed) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <span class="ml-2">Concluída</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4">
                <x-primary-button
                    href="{{ route('dashboard') }}"
                    method="GET"
                    bgColor="bg-gray-300"
                    hoverBgColor="hover:bg-gray-400"
                    textColor="text-gray-700"
                    class="mr-2"
                >
                    Cancelar
                </x-primary-button>
                <x-primary-button>
                    Atualizar Tarefa
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection 