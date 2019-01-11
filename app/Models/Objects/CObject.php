<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class CObject extends Model
{
    protected $table = 'objects';

    const DEFAULT_FILENAME = 'object_default.jpg';

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function infoparts()
    {
        return $this->hasMany(InfoPart::class, 'object_id');
    }

    public function persons()
    {
        return $this->hasMany(Person::class, 'object_id');
    }

    public function getFullName()
    {
        return $this->code . ' - ' . $this->name;
    }

    public function getDestinationPath() {
        return 'objects/';
    }

    public function getImageUrl()
    {
        return \Storage::url($this->getImagePath());
    }

    public function getImagePath()
    {
        $filename = is_null($this->image) ? self::DEFAULT_FILENAME : $this->image;
        return $this->getDestinationPath() . $filename;
    }
}
