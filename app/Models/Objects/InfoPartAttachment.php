<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class InfoPartAttachment extends Model
{
    protected $table = 'object_infopart_attachments';

    public function infopart()
    {
        return $this->belongsTo(InfoPart::class);
    }
}
