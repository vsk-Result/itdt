<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Models\Knowledge\Article;
use App\Models\Knowledge\Tag;
use App\UseCases\Knowledge\ArticleService;
use function GuzzleHttp\Promise\task;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $article = $this->service->create($request);
        return redirect()->back();
    }

    public function show(Article $article)
    {
        $access = $article->hasLinkAccess();
        $article_link = $article->getLink();
        return response()->json(compact('article', 'article_link', 'access'));
    }

    public function edit(Article $article)
    {
        $icon = $article->icon->name;
        $tags = implode(', ', $article->tags->pluck('name')->toArray());
        return response()->json(compact('article', 'tags', 'icon'));
    }

    public function update(Article $article, Request $request)
    {
        $this->service->update($article->id, $request);
        return redirect()->back();
    }

    public function destroy(Article $article)
    {
        $this->service->destroy($article->id);
        return redirect()->back();
    }

    public function link($link)
    {
        $article = $this->service->findByLink($link);
        return ($article && $article->hasLinkAccess()) ? view('knowledge.link', compact('article')) : abort(404);
    }
}
