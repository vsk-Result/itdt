<?php

namespace App\Models\Knowledge;

use App\Models\Icon;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $table = 'knowledge_articles';

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'category_id', 'icon_id', 'title', 'content', 'link', 'link_access'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function icon()
    {
        return $this->belongsTo(Icon::class, 'icon_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'knowledge_article_tag', 'article_id', 'tag_id');
    }

    public function getDestinationPath() {
        return 'articles/';
    }

    public function hasLinkAccess()
    {
         return $this->link_access;
    }

    public function getLink()
    {
        return route('knowledge.articles.short_link', $this->link);
    }

    public function scopeForUser($query)
    {
        return $query->where('link_access', true);
    }
}
