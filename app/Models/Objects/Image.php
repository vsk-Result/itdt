<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $table = 'object_images';
    protected $dates = ['deleted_at'];

    public function object()
    {
        return $this->belongsTo(CObject::class, 'object_id');
    }

    public function getUrl()
    {
        return \Storage::url($this->getPath());
    }

    public function getPath()
    {
        return $this->object->getDestinationPath() . $this->filename;
    }
}
