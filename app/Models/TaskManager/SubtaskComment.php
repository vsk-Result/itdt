<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;

class SubtaskComment extends Model
{
    protected $table = 'task_subtask_comments';

    public function subtask()
    {
        return $this->belongsTo(Subtask::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getText()
    {
        return findLinks($this->text);
    }
}
