<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees\Employee;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->text;
        $employees = Employee::where('fullname', 'LIKE', '%' . $query . '%')->get();
        $view_render = view('sidebars.index', compact('employees'))->render();

        return response()->json(compact('view_render'));
    }

}
