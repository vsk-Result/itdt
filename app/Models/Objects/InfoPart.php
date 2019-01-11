<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class InfoPart extends Model
{
    protected $table = 'object_infoparts';

    public function object()
    {
        return $this->belongsTo(CObject::class, 'object_id');
    }

    public function attachments()
    {
        return $this->hasMany(InfoPartAttachment::class, 'infopart_id');
    }
}
