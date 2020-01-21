<?php

namespace App\UseCases\TaskManager;

use App\Models\TaskManager\Subtask;

class SubTaskService
{
    public function comments($subtask)
    {
        $comments_count = $subtask->comments->count();
        return $comments_count;
    }

    public function find(int $id)
    {
        return SubTask::findOrFail($id);
    }
}
