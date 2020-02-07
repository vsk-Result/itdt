<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $permission = auth()->user()->permissions()->orderBy('id', 'ASC')->first();
        if ($permission) {
            return redirect()->route($permission->route . '.index');
        }

        return view('home');
    }
}
