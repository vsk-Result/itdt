<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subtask extends Model
{
    use SoftDeletes;

    protected $table = 'task_subtasks';
    protected $touches = ['task'];
    protected $dates = ['deleted_at'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function comments()
    {
        return $this->hasMany(SubtaskComment::class);
    }

    public function scopeChecked($query)
    {
        return $query->where('checked', true);
    }

    public static function getDefaultName()
    {
        return 'Без названия';
    }
}
