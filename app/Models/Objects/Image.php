<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $table = 'object_images';
    protected $dates = ['deleted_at'];

    protected $fillable = ['object_id', 'filename', 'description', 'order'];

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
        return self::getDestinationPath() . $this->filename;
    }

    public static function getDestinationPath() {
        return 'objects/gallery/';
    }

    public function getThumbUrl()
    {
        return \Storage::url($this->getThumbPath());
    }

    public function getThumbPath()
    {
        return self::getDestinationPath() . 'thumbs/' . $this->filename;
    }
}
