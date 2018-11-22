<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'object_images';

    public function object()
    {
        return $this->belongsTo(CObject::class);
    }
}
