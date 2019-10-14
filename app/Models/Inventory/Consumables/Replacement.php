<?php

namespace App\Models\Inventory\Consumables;

use App\User;
use App\Models\Objects\CObject;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\Printer\Printer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Replacement extends Model
{
    use SoftDeletes;

    protected $table = 'consumable_replacements';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at', 'replaced_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function printer()
    {
        return $this->belongsTo(Printer::class, 'printer_id', 'id')->withTrashed();
    }

    public function object()
    {
        return $this->belongsTo(CObject::class, 'object_id', 'id');
    }

    public function consumable()
    {
        return $this->belongsTo(Consumable::class, 'consumable_id', 'id');
    }
}
