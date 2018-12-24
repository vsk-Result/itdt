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
        return $this->findLinks($this->text);
    }

    private function findLinks($text) {
        $regex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';
        return preg_replace_callback($regex, function ($matches) {
            return '<a target="_blank" href="' . $matches[0] . '">' . $matches[0] . '</a>';
        }, $text);
    }
}
