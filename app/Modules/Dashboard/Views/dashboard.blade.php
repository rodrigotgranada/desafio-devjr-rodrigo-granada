@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Minhas Tarefas</h2>
        @include('components.primary-button', [
            'href' => route('tasks.create'),
            'color' => 'indigo',
            'label' => 'Nova Tarefa'
        ])
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        @include('dashboard::components.cards.productivity-card', [
            'title' => 'Produtividade semanal',
            'text' => '<span class="font-semibold">' . $completedThisWeek . '</span> tarefas concluídas nesta semana<br>
                    <span class="font-semibold">' . $completedLastWeek . '</span> tarefas concluídas na semana passada',
            'bgColor' => 'bg-blue-100',
            'textColor' => 'text-blue-800'
        ])

        @include('dashboard::components.cards.productivity-card', [
            'title' => 'Tarefas no prazo',
            'text' => '<span class=\"font-semibold\">' . $doneOnTime . '</span> de <span class=\"font-semibold\">' . $shouldBeCompleted . '</span> tarefas com prazo para esta semana foram concluídas',
            'bgColor' => 'bg-green-100',
            'textColor' => 'text-green-800'
        ])
    </div>

    <div class="flex gap-4 mb-4">
        @include('dashboard::components.filters.filter')
        @include('dashboard::components.filters.sort')
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($tasks as $task)
            @include('dashboard::components.cards.content-card', ['task' => $task])
        @endforeach
    </div>

    @if($tasks->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">Você ainda não tem tarefas. Crie uma nova tarefa para começar!</p>
        </div>
    @endif

<script>
function toggleDropdown(id) {
    document.getElementById(id).classList.toggle('hidden');
}
</script>
@endsection
