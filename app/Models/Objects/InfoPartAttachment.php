<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class InfoPartAttachment extends Model
{
    protected $table = 'object_infopart_attachments';

    protected $fillable = ['infopart_id', 'filename'];

    public function infopart()
    {
        return $this->belongsTo(InfoPart::class, 'infopart_id');
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
        return 'objects/infopart/';
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
