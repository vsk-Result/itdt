<?php

use Illuminate\Database\Seeder;
use App\Models\Knowledge\Category;
use App\Models\Knowledge\Tag;
use App\Models\Knowledge\Article;
use App\Models\Icon;

class KnowledgeSeeder extends Seeder
{
    public function run()
    {
        factory(Category::class, 5)->create()->each(function(Category $category) {
            $category->articles()->saveMany(factory(Article::class, 3)->create()->each(function(Article $article) {
                $article->tags()->saveMany(factory(Tag::class, 3)->make());
            }));
        });
    }
}
