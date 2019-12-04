<?php

namespace App\Models\Inventory\Order;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Objects\CObject;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'consumable_orders';

    protected $fillable = ['user_id', 'object_id', 'responsible'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function object()
    {
        return $this->belongsTo(CObject::class, 'object_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'order_id', 'id');
    }
}
