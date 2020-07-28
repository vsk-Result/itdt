<?php

namespace App\Models\Knowledge;

use App\Models\Icon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'knowledge_categories';

    protected $fillable = ['name', 'visible_for_user'];

    public $timestamps = false;

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    public function icon()
    {
        return $this->belongsTo(Icon::class, 'icon_id', 'id');
    }

    public function scopeForUser($query)
    {
        return $query->whereHas('articles', function($query) {
            $query->where('link_access', true);
        });
    }
}
