<?php

namespace App\UseCases\Knowledge;

use App\Models\Knowledge\Article;
use App\Models\Knowledge\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleService
{
    public function create(Request $request): Article
    {
        return DB::transaction(function () use ($request) {

            $article = Article::make([
                'user_id' => Auth::id(),
                'icon_id' => $request['icon_id'],
                'category_id' => $request['category_id'],
                'title' => $request['title'],
                'content' => $request['content'],
                'link' => $this->generateLink(),
                'link_access' => false
            ]);

            $article->saveOrFail();
            $this->updateTags($article, $request->tags);

            return $article;
        });
    }

    public function update($id, Request $request): void
    {
        $article = $this->getArticle($id);
        $article->update([
            'icon_id' => $request->icon_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'link_access' => $request->has('link_access'),
            'content' => $request->content,
        ]);

        $this->updateTags($article, $request->tags);
    }

    public function destroy($id): void
    {
        $article = $this->getArticle($id);
        $article->tags()->sync([]);
        $article->delete();
    }

    public function getArticle($id): Article
    {
        return Article::findOrFail($id);
    }

    private function updateTags(Article $article, $tags): void
    {
        if (!empty($tags) && !is_null($tags)) {
            $tag_ids = [];
            $tags = explode(', ', $tags);
            foreach ($tags as $tag_name) {
                $tag = Tag::where('name', $tag_name)->first();
                if (!$tag) {
                    $tag = Tag::create([
                        'name' => $tag_name
                    ]);
                }
                $tag_ids[] = $tag->id;
            }
            $article->tags()->sync($tag_ids);
        }
    }

    public function generateLink(): string
    {
        return Str::random(8);
    }

    public function findByLink($link)
    {
        return Article::where('link', $link)->first();
    }
}