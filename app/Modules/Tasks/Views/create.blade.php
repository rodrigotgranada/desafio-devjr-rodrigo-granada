@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold">Nova Tarefa</h2>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-input-label for="title">Título</x-input-label>
                <x-text-input name="title" id="title" :value="old('title')" required />
                <x-error field="title" />
            </div>

            <div class="mb-4">
                <x-input-label for="description">Descrição</x-input-label>
                <x-textarea name="description" id="description" rows="3" required />
                <x-error field="description" />
            </div>

            <div class="mb-4">
                <x-input-label for="due_date">Prazo</x-input-label>
                <x-text-input name="due_date" id="due_date" type="datetime-local" :value="old('due_date')" required />
                <x-error field="due_date" />
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
                    Criar Tarefa
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection 