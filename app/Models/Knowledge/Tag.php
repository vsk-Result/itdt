<?php

namespace App\Models\Knowledge;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    protected $table = 'knowledge_tags';

    protected $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'knowledge_article_tag', 'tag_id', 'article_id');
    }
}
