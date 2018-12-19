<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class CObject extends Model
{
    protected $table = 'objects';

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function infoparts()
    {
        return $this->hasMany(InfoPart::class);
    }

    public function persons()
    {
        return $this->hasMany(Person::class, 'object_id');
    }

    public function getFullName()
    {
        return $this->code . ' - ' . $this->name;
    }
}
