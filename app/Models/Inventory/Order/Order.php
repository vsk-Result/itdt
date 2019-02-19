<?php

namespace App\Models\Inventory\Order;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'consumable_orders';

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'order_id', 'id');
    }
}
