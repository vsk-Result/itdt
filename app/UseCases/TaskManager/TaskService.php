<?php

namespace App\UseCases\TaskManager;

use App\Models\TaskManager\Task;

class TaskService
{
    public function store()
    {
        $task = new Task();
        $task->user_id = auth()->id();
        $task->priority_id = Priority::DEFAULT_ID;
        $task->status_id = Status::DEFAULT_ID;
        $task->type_id = Type::DEFAULT_ID;
        $task->object_id = null;
        $task->name = Task::getDefaultName();
        $task->save();

        return $task;
    }

    public function find(int $id)
    {
        return Task::findOrFail($id);
    }
}
