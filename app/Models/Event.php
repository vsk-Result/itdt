<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\Employee;

class Event extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $table = 'events';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function start_date($value="H:i d.m.Y") {
      return Carbon::parse($this->start_date)->format($value);
    }

    public function end_date($value="H:i d.m.Y") {
      return Carbon::parse($this->end_date)->format($value);
    }
  }
