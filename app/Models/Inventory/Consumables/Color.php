<?php

namespace App\Models\Inventory\Consumables;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    public $timestamps = false;

    protected $fillable = ['name', 'hex_color'];
}
