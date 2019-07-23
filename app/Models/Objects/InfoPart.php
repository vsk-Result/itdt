<?php

namespace App\Models\Objects;

use App\Models\Icon;
use Illuminate\Database\Eloquent\Model;

class InfoPart extends Model
{
    protected $table = 'object_infoparts';

    protected $fillable = ['object_id', 'icon_id', 'title', 'body', 'order'];

    public function object()
    {
        return $this->belongsTo(CObject::class, 'object_id');
    }

    public function icon()
    {
        return $this->belongsTo(Icon::class, 'icon_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(InfoPartAttachment::class, 'infopart_id');
    }
}
