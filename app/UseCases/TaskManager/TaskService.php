<?php

namespace App\UseCases\TaskManager;

use App\Models\TaskManager\Task;

class TaskService
{
    public function store()
    {
        
    }

    public function find(int $id)
    {
        return Task::findOrFail($id);
    }
}
