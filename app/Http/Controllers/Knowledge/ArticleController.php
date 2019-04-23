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
        return response()->json(compact('article'));
    }

    public function edit(Article $article)
    {
        $tags = implode(', ', $article->tags->pluck('name')->toArray());
        return response()->json(compact('article', 'tags'));
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
}
