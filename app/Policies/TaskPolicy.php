<?php

namespace App\Policies;

use App\Models\{Task, User};

class TaskPolicy
{
    public function view(User $user, Task $task): bool
    {
        return $user->is($task->user);
    }

    public function update(User $user, Task $task): bool
    {
        return $user->is($task->user);
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->is($task->user);
    }

}
