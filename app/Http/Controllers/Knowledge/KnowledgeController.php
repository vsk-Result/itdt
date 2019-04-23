<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use App\Models\Knowledge\Category;

class KnowledgeController extends Controller
{
    public function index()
    {
        $icons = Icon::all();
        $categories = Category::with('articles')->orderBy('name')->get();
        return view('knowledge.index', compact('categories', 'icons'));
    }
}
