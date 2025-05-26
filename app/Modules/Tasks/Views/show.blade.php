@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg max-w-xl mx-auto mt-8">
    <div class="p-6 text-gray-900">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">{{ $task->title }}</h2>
            <x-status-badge :completed="$task->completed" :due-date="$task->due_date" />
        </div>
        <p class="mb-2 text-sm text-gray-500">Criado: {{ $task->created_at->format('d/m/Y H:i') }}</p>
        <p class="mb-4 text-sm text-gray-500">Prazo: {{ $task->due_date->format('d/m/Y H:i') }}</p>
        @if($task->completed && $task->completed_at)
            <p class="mb-4 text-sm text-green-700">Concluída em: {{ $task->completed_at->format('d/m/Y H:i') }}</p>
        @endif
        <div class="mb-6">
            <h3 class="font-semibold mb-1">Descrição</h3>
            <p class="text-gray-700">{{ $task->description }}</p>
        </div>
        <div class="flex gap-2 justify-end" x-data="{ showDeleteModal: false }">
            <x-primary-button
                href="{{ route('dashboard') }}"
                method="GET"
                bgColor="bg-gray-300"
                hoverBgColor="hover:bg-gray-400"
                textColor="text-gray-700"
                title="Voltar"
                class="mr-2"
            >
                @include('components.icons.arrow-left')
            </x-primary-button>
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
                @click="showDeleteModal = true"
            >
                @include('components.icons.trash')
            </x-primary-button>
            <x-confirm-modal
                :action="route('tasks.destroy', $task)"
                method="DELETE"
                message="Tem certeza que deseja excluir a tarefa '{{ $task->title }}'?"
                confirmText="Excluir"
                cancelText="Cancelar"
                xShow="showDeleteModal"
            />
        </div>
    </div>
</div>
@endsection 