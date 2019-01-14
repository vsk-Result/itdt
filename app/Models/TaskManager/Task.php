<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    protected $table = 'tasks';
    protected $dates = ['completed_at'];

    const COMPLETE_STATUS_ID = 3;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function complete_user()
    {
        return $this->belongsTo('App\User', 'user_complete_id');
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

    public function getCompletePercentage($as_title = null)
    {
        $subtasks_count = $this->subtasks->count();
        $checked_subtasks = $this->checkedSubtasks->count();

        if ($as_title) {
            return $checked_subtasks . '/' . $subtasks_count;
        }
        return round($checked_subtasks * 100 / $subtasks_count, 2);
    }

    public function getDestinationPath() {
        return 'task-manager/';
    }

    public function isTaskType()
    {
        return $this->type->name == 'Задача';
    }

    public function isComplete()
    {
        return $this->status_id == self::COMPLETE_STATUS_ID;
    }

    public function getDescription()
    {
        return findLinks($this->description);
    }
}
