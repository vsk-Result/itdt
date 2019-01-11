<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'object_persons';

    const DEFAULT_FILENAME = 'person_default.jpg';

    public function object()
    {
        return $this->belongsTo(CObject::class, 'object_id');
    }

    public function getImageUrl()
    {
        return \Storage::url($this->getImagePath());
    }

    public function getImagePath()
    {
        $filename = is_null($this->image) ? self::DEFAULT_FILENAME : $this->image;
        return $this->object->getDestinationPath() . $filename;
    }
}
