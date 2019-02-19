<?php

namespace App\Models\Inventory\Order;

use App\Models\Inventory\Consumables\Consumable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'consumable_order_items';

    public $timestamps = false;

    protected $fillable = ['order_id', 'consumable_id', 'count'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function consumable()
    {
        return $this->belongsTo(Consumable::class, 'consumable_id', 'id');
    }
}
