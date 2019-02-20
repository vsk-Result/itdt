<?php

namespace App\Models\Inventory\Consumables;

use App\Models\Inventory\Printer\PModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumable extends Model
{
    use SoftDeletes;

    protected $table = 'consumables';

    protected $dates = ['deleted_at'];

    protected $fillable = ['color_id', 'name', 'file'];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function printers()
    {
        return $this->belongsToMany(PModel::class, 'printer_consumable', 'consumable_id', 'printer_id');
    }

    public function movements()
    {
        return $this->hasMany(Movement::class, 'consumable_id', 'id');
    }

    public function replacements()
    {
        return $this->hasMany(Replacement::class, 'consumable_id', 'id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'consumable_id', 'id');
    }

    public function getFullName()
    {
        return $this->name . ' - ' . $this->getColorName();
    }

    public function getHexColor()
    {
        return $this->color->hex_color;
    }

    public function getColorName()
    {
        return $this->color->name;
    }

    public function getMovements()
    {
        return $this->movements()->with('user', 'confirmUser', 'sender', 'recipient')->orderByDesc('created_at')->get();
    }

    public function getReplacements()
    {
        return $this->replacements()->with('user', 'printer')->orderByDesc('created_at')->get();
    }

    public function scopeForPrinterModel($query, $model_id)
    {
        return $query->whereHas('printers', function($subQuery) use($model_id) {
            $subQuery->where('id', $model_id);
        });
    }

    public function getPrintersList()
    {
        $list = [];
        foreach ($this->printers as $model) {
            foreach ($model->printers as $printer) {
                $list[$printer->id] = $printer->getFullName();
            }
        }
        return $list;
    }
}
