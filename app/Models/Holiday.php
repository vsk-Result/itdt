<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Holiday extends Model
{
    protected $table = 'holidays';
    public $timestamps = false;

    public function getDateAttribute($value)
    {
      return Carbon::now()->year. '-' .$value;
    }
}
