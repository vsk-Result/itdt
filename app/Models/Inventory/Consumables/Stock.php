<?php

namespace App\Models\Inventory\Consumables;

use App\Models\Objects\CObject;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'consumable_stocks';

    public $timestamps = false;

    protected $fillable = ['object_id', 'consumable_id', 'count'];

    public function object()
    {
        return $this->belongsTo(CObject::class, 'object_id', 'id');
    }

    public function consumable()
    {
        return $this->belongsTo(Consumable::class, 'consumable_id', 'id');
    }
}
