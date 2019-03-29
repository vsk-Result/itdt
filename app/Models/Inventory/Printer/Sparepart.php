<?php

namespace App\Models\Inventory\Printer;

use App\Models\Objects\CObject;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sparepart extends Model
{
    use SoftDeletes;

    protected $table = 'spareparts';

    protected $dates = ['deleted_at'];

    protected $fillable = ['model_id', 'user_id', 'name', 'part_number', 'url'];

    public function model()
    {
        return $this->belongsTo(PModel::class, 'model_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeForModel($query, $model_id)
    {
        return $query->where('model_id', $model_id);
    }
}
