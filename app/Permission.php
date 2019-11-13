<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['slug', 'name'];
}
