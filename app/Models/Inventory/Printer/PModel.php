<?php

namespace App\Models\Inventory\Printer;

use App\Models\Inventory\Consumables\Consumable;
use Illuminate\Database\Eloquent\Model;

class PModel extends Model
{
    protected $table = 'printer_models';

    public $timestamps = false;

    protected $fillable = ['name'];

    public function consumables()
    {
        return $this->belongsToMany(Consumable::class, 'printer_consumable', 'printer_id', 'consumable_id');
    }

    public function printers()
    {
        return $this->hasMany(Printer::class, 'model_id', 'id');
    }
}
