<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use App\Models\Knowledge\Category;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {dd($request->all()); }
        $icons = Icon::all();
        $categories = Category::with('articles')->orderBy('name')->get();
        return view('knowledge.index', compact('categories', 'icons'));
    }
}
