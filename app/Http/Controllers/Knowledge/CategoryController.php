<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Models\Knowledge\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $category = new Category();
        $category->icon_id = $request->icon_id;
        $category->name = $request->name;
        $category->save();

        return redirect()->back();
    }
}
