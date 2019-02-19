<?php

namespace App\Models\Inventory\Printer;

use App\Models\Objects\CObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Printer extends Model
{
    use SoftDeletes;

    protected $table = 'printers';

    protected $dates = ['deleted_at'];

    protected $fillable = ['model_id', 'object_id', 'name', 'description', 'file'];

    public function model()
    {
        return $this->belongsTo(PModel::class, 'model_id', 'id');
    }

    public function object()
    {
        return $this->belongsTo(CObject::class, 'object_id', 'id');
    }

    public function scopeForModel($query, $model_id)
    {
        return $query->where('model_id', $model_id);
    }

    public function getFullName()
    {
        return $this->name . (empty($this->description) ?: ' (' . $this->description . ')');
    }
}
