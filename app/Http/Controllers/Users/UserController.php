<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Permission;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users');
    }

    public function index(Request $request)
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $permissions = Permission::pluck('name', 'id');
        return view('users.edit', compact('user', 'permissions'));
    }

    public function update(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        $user->permissions()->sync($request->permissions);
        return redirect()->route('users.index');
    }
}
