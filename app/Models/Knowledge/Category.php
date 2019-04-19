<?php

namespace App\Models\Knowledge;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'knowledge_categories';

    protected $fillable = ['name', 'icon'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
