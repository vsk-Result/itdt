<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Employees\Employee;
use App\Permission;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users')->except('filter', 'online');
    }

    public function index(Request $request)
    {
        $users = User::orderBy('name')->with('employee', 'permissions')->get();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $permissions = Permission::pluck('name', 'id');
        $employees = [null => 'Отсутствует'] + Employee::orderBy('fullname')->pluck('fullname', 'id')->toArray();
        return view('users.edit', compact('user', 'permissions', 'employees'));
    }

    public function update(User $user, Request $request)
    {
        $user->permissions()->sync($request->permissions);

        $users = User::where('employee_id', $request->employee_id)->get();
        foreach ($users as $user) {
            $user->employee_id = null;
            $user->update();
        }

        $user->employee_id = $request->employee_id;
        $user->is_active = $request->is_active;
        $user->update();

        return redirect()->route('users.index');
    }

    public function filter(Request $request)
    {
        $query = $request->text;
        $employees = Employee::where('fullname', 'LIKE', '%' . $query . '%')->orderBy('fullname')->get();
        $view_render = view('employees.search_list', compact('employees'))->render();
        $count = $employees->count();
        return response()->json(compact('view_render', 'count'));
    }

    public function online(Request $request)
    {
        $employeeIds = User::getOnlineEmployeeIds();
        $employees = Employee::whereIn('id', $employeeIds)->orderBy('fullname')->get();
        $view_render = view('employees.search_list', compact('employees'))->render();
        $count = $employees->count();
        return response()->json(compact('view_render', 'count'));
    }

    public function toggleActive(User $user)
    {
        $user->update([
            'is_active' => !$user->isActive()
        ]);
        return response()->json(['is_active' => $user->isActive()]);
    }
}
