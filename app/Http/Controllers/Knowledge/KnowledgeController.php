<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use App\Models\Knowledge\Article;
use App\Models\Knowledge\Category;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:knowledge');
    }

    public function index(Request $request)
    {
        $icons = Icon::all();
        $categoriesQuery = Category::query();

        if (!auth()->user()->hasPermission('task_manager')) {
            $categoriesQuery->forUser();
        }

        $categories = $categoriesQuery->with('articles')->orderBy('name')->get();

        return view('knowledge.index', compact('categories', 'icons'));
    }

    public function filter(Request $request)
    {
        $category = $request->category;
        $categoriesQuery = Category::query();

        if (!auth()->user()->hasPermission('task_manager')) {
            $categoriesQuery->forUser();
        }

        if (is_null($request->tags))  {

            if (!auth()->user()->hasPermission('task_manager')) {
                $categoryList = $categoriesQuery->with(['articles' => function ($query) {
                    $query->where('link_access', true);
                }])->orderBy('name')->get();
            } else {
                $categoryList = $categoriesQuery->with('articles')->orderBy('name')->get();
            }

            if ($category != 'all') {
                if (!auth()->user()->hasPermission('task_manager')) {
                    $categoryList = $categoriesQuery->where('id', $category)->with(['articles' => function ($query) {
                        $query->where('link_access', true);
                    }])->orderBy('name')->get();
                } else {
                    $categoryList = $categoriesQuery->where('id', $category)->with('articles')->orderBy('name')->get();
                }

            }
            return response()->json(['view_render' => view('knowledge.partials.categories', compact('categoryList'))->render()]);
        }

        $articleIds = [];
        foreach ($request->tags as $tag) {

            $articlesQuery = Article::query();

            if (!auth()->user()->hasPermission('task_manager')) {
                $articlesQuery->forUser();
            }

            $articlesIds = $articlesQuery->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', 'LIKE', '%' . $tag['value'] . '%');
            })->pluck('id')->toArray();

            if (count($articlesIds) > 0) {
                $articleIds = array_merge($articleIds, $articlesIds);
            }
        }
        $articleIds = array_unique($articleIds);
        if ($category == 'all') {
            $categoryList = $categoriesQuery->whereHas('articles', function ($query) use ($articleIds) {
                $query->whereIn('id', $articleIds);
            })->with(['articles' => function ($query) use ($articleIds) {
                $query->whereIn('id', $articleIds);
            }])->get();
        } else {
            $categoryList = $categoriesQuery->where('id', $category)->whereHas('articles', function ($query) use ($articleIds) {
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
