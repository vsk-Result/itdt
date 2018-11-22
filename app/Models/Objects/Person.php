<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'object_persons';

    public function object()
    {
        return $this->belongsTo(CObject::class);
    }
}
