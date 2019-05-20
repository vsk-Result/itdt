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
                'content' => '',
                'link' => $this->generateLink(),
                'link_access' => false
            ]);

            $article->saveOrFail();
            $this->updateTags($article, $request->tags);
            $this->updateContent($article, $request->content);

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
        ]);

        $this->updateTags($article, $request->tags);
        $this->updateContent($article, $request->content);
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

    private function updateContent(Article $article, $content): void
    {
        $dom = new \DomDocument();
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');
        foreach($images as $key => $img) {

            $filename = $article->id . '_' . str_random(2) . '_' . rus2translit($img->getAttribute('data-filename'));
            $data = $img->getAttribute('src');
            if (strpos($data, ';') > 0) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);

                $path = storage_path() . "/app/public/articles/" . $filename;
                file_put_contents($path, $data);


                $img->removeAttribute('src');
                $img->setAttribute('src', '/storage/articles/'. $filename);
            }
        }

        $article->content = $dom->saveHTML();
        $article->update();
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