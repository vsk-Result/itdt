<?php

namespace App\Http\Controllers\Objects;

use App\Models\Objects\CObject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ObjectController extends Controller
{
    public function index()
    {
        $objects = CObject::orderBy('code')->get();
        return view('objects.index', compact('objects'));
    }

    public function show($id)
    {
        $object = CObject::findOrFail($id);
        return view('objects.show', compact('object'));
    }
}
