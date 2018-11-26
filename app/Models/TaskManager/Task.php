<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    protected $table = 'tasks';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }

    public function checkedSubtasks()
    {
        return $this->hasMany(Subtask::class)->checked();
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public static function getDefaultName()
    {
        return 'НОВАЯ ЗАДАЧА';
    }

    public function getCompletePercentage()
    {
        $subtasks_count = $this->subtasks->count();
        $checked_subtasks = $this->checkedSubtasks->count();
        return $subtasks_count == 0 ? 0 : round($checked_subtasks * 100 / $subtasks_count, 2);
    }

    public function getDestinationPath() {
        return 'task-manager/';
    }

    public function isTaskType()
    {
        return $this->type->name == 'Задача';
    }
}
