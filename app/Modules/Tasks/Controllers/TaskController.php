<?php

namespace App\Modules\Tasks\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Tasks\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $allowedSorts = ['title', 'created_at', 'completed_at'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        $query = auth()->user()->tasks();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        if ($request->filled('created_at')) {
            $start = \Carbon\Carbon::parse($request->created_at, 'America/Sao_Paulo')->startOfDay()->setTimezone('UTC');
            $end = \Carbon\Carbon::parse($request->created_at, 'America/Sao_Paulo')->endOfDay()->setTimezone('UTC');
            $query->whereBetween('created_at', [$start, $end]);
        }
        if ($request->filled('completed_at')) {
            $start = \Carbon\Carbon::parse($request->completed_at, 'America/Sao_Paulo')->startOfDay()->setTimezone('UTC');
            $end = \Carbon\Carbon::parse($request->completed_at, 'America/Sao_Paulo')->endOfDay()->setTimezone('UTC');
            $query->whereBetween('completed_at', [$start, $end]);
        }

        $user = auth()->user();

        $startThisWeek = Carbon::now('America/Sao_Paulo')->startOfWeek();
        $endThisWeek = Carbon::now('America/Sao_Paulo')->endOfWeek();
        $startLastWeek = Carbon::now('America/Sao_Paulo')->subWeek()->startOfWeek();
        $endLastWeek = Carbon::now('America/Sao_Paulo')->subWeek()->endOfWeek();

        $completedThisWeek = $user->tasks()
            ->where('completed', true)
            ->whereBetween('completed_at', [$startThisWeek, $endThisWeek])
            ->count();

        $completedLastWeek = $user->tasks()
            ->where('completed', true)
            ->whereBetween('completed_at', [$startLastWeek, $endLastWeek])
            ->count();

        $shouldBeCompleted = $user->tasks()
            ->whereBetween('due_date', [$startThisWeek, $endThisWeek])
            ->count();

        $doneOnTime = $user->tasks()
            ->where('completed', true)
            ->whereBetween('due_date', [$startThisWeek, $endThisWeek])
            ->count();

        $tasks = $query->orderBy($sort, $order)->get();

        $tasks->transform(function ($task) {
            $task->created_at = \Carbon\Carbon::parse($task->created_at)->timezone('America/Sao_Paulo');
            $task->due_date = \Carbon\Carbon::parse($task->due_date)->timezone('America/Sao_Paulo');
            return $task;
        });

        return view('dashboard::dashboard', compact(
            'tasks', 'sort', 'order',
            'completedThisWeek', 'completedLastWeek',
            'shouldBeCompleted', 'doneOnTime'
        ));
    }

    public function create()
    {
        return view('tasks::create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $validated['due_date'] = \Carbon\Carbon::parse($validated['due_date'], 'America/Sao_Paulo')->setTimezone('UTC');

        $task = auth()->user()->tasks()->create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Tarefa criada com sucesso!');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        $task->created_at = \Carbon\Carbon::parse($task->created_at)->timezone('America/Sao_Paulo');
        $task->due_date = \Carbon\Carbon::parse($task->due_date)->timezone('America/Sao_Paulo');
        return view('tasks::show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $task->created_at = \Carbon\Carbon::parse($task->created_at)->timezone('America/Sao_Paulo');
        $task->due_date = \Carbon\Carbon::parse($task->due_date)->timezone('America/Sao_Paulo');
        return view('tasks::edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'completed' => 'boolean',
        ]);

        if (isset($validated['completed'])) {
            if ($validated['completed'] && !$task->completed) {
                $task->completed_at = \Carbon\Carbon::now('America/Sao_Paulo');
            } elseif (!$validated['completed']) {
                $task->completed_at = null;
            }
        }

        $validated['due_date'] = \Carbon\Carbon::parse($validated['due_date'], 'America/Sao_Paulo')->setTimezone('UTC');

        $task->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        
        $task->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Tarefa excluída com sucesso!');
    }

    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);

        if (!$task->completed) {
            $task->completed = true;
            $task->completed_at = \Carbon\Carbon::now('America/Sao_Paulo');
        } else {
            $task->completed = false;
            $task->completed_at = null;
        }
        $task->save();

        return redirect()->back();
    }
} 