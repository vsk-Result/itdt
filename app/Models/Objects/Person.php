<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    const DEFAULT_FILENAME = 'person_default.jpg';

    protected $table = 'object_persons';

    protected $fillable = ['object_id', 'fullname', 'appointment', 'phone', 'email', 'link', 'image'];

    public function object()
    {
        return $this->belongsTo(CObject::class, 'object_id');
    }

    public function getFilename()
    {
        return is_null($this->image) ? self::DEFAULT_FILENAME : $this->image;
    }

    public static function getDestinationPath() {
        return 'objects/person/';
    }

    public function getImageUrl()
    {
        return \Storage::url($this->getImagePath());
    }

    public function getImagePath()
    {
        return self::getDestinationPath() . $this->getFilename();
    }

    public function getThumbUrl()
    {
        return \Storage::url($this->getThumbPath());
    }

    public function getThumbPath()
    {
        return self::getDestinationPath() . 'thumbs/' . $this->getFilename();
    }
}
