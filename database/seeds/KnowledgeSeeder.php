<?php

use Illuminate\Database\Seeder;
use App\Models\Knowledge\Category;
use App\Models\Knowledge\Tag;
use App\Models\Knowledge\Article;

class KnowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::pluck('id');
        factory(Article::class, 4)->create()->each(function($article) use ($tags) {
            $article->tags()->sync($tags);
        });
    }
}
