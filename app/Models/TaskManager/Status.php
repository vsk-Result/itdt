<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'task_statuses';

    const DEFAULT_ID = 1;
}
