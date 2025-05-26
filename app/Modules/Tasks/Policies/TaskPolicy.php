<?php

namespace App\Modules\Tasks\Policies;

use App\Modules\Auth\Models\User;
use App\Modules\Tasks\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function restore(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function forceDelete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function completedThisWeek(Task $task)
    {
        return $task->completed_at && $task->completed_at->isBetween(
            \Carbon\Carbon::now('America/Sao_Paulo')->startOfWeek(), \Carbon\Carbon::now('America/Sao_Paulo')->endOfWeek()
        );
    }
} 