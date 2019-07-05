<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use App\Models\Knowledge\Article;
use App\Models\Knowledge\Category;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    public function index(Request $request)
    {
        $icons = Icon::all();
        $categories = Category::with('articles')->orderBy('name')->get();
        return view('knowledge.index', compact('categories', 'icons'));
    }

    public function filter(Request $request)
    {
        $category = $request->category;
        if (is_null($request->tags))  {
            $categoryList = Category::with('articles')->orderBy('name')->get();
            if ($category != 'all') {
                $categoryList = Category::where('id', $category)->with('articles')->orderBy('name')->get();
            }
            return response()->json(['view_render' => view('knowledge.partials.categories', compact('categoryList'))->render()]);
        }

        $articleIds = [];
        foreach ($request->tags as $tag) {
            $articlesIds = Article::whereHas('tags', function ($query) use ($tag) {
                $query->where('name', 'LIKE', '%' . $tag['value'] . '%');
            })->pluck('id')->toArray();
            if (count($articlesIds) > 0) {
                $articleIds = array_merge($articleIds, $articlesIds);
            }
        }
        $articleIds = array_unique($articleIds);
        if ($category == 'all') {
            $categoryList = Category::whereHas('articles', function ($query) use ($articleIds) {
                $query->whereIn('id', $articleIds);
            })->with(['articles' => function ($query) use ($articleIds) {
                $query->whereIn('id', $articleIds);
            }])->get();
        } else {
            $categoryList = Category::where('id', $category)->whereHas('articles', function ($query) use ($articleIds) {
                $query->whereIn('id', $articleIds);
            })->with(['articles' => function ($query) use ($articleIds) {
                $query->whereIn('id', $articleIds);
            }])->get();
        }

        if ($categoryList->count() == 0) {
            return response()->json(['view_render' => '<p>Поиск не принес результатов.</p>']);
        }

        return response()->json(['view_render' => view('knowledge.partials.categories', compact('categoryList'))->render()]);
    }
}
