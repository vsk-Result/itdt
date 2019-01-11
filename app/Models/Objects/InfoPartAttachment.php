<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class InfoPartAttachment extends Model
{
    protected $table = 'object_infopart_attachments';

    public function infopart()
    {
        return $this->belongsTo(InfoPart::class, 'infopart_id');
    }

    public function getUrl()
    {
        return Storage::url($this->getPath());
    }

    public function getPath()
    {
        return $this->infopart->object->getDestinationPath() . $this->filename;
    }
}
