<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Employees\Post;
use App\User;

class Employee extends Model
{
    protected $table = 'employees';

    use SoftDeletes;

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
