<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'task_types';
    public $timestamps = false;

    const DEFAULT_ID = 3;
}
