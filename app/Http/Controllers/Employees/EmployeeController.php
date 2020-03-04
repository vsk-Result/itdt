<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Models\Employees\Employee;
use App\Models\Employees\Post;
use App\Services\Upload\Uploader;
use App\UseCases\SignService;
use Illuminate\Http\Request;
use App\User;

class EmployeeController extends Controller
{
    private $uploader;
    private $signService;

    public function __construct(SignService $signService, Uploader $uploader)
    {
        $this->signService = $signService;
        $this->uploader = $uploader;
    }

    public function index()
    {
        $employees = Employee::orderBy('fullname')->with('post', 'leader')->get();
        return view('employees.index', compact('employees'));
    }

    public function show(Employee $employee)
    {
        $posts = [null => 'Отсутствует'] + Post::orderBy('name')->pluck('name', 'id')->toArray();
        $users = [null => 'Отсутствует'] + User::orderBy('username')->pluck('username', 'id')->toArray();
        $leaders = [null => 'Отсутствует'] + Employee::where('id', '!=', $employee->id)->orderBy('fullname')->pluck('fullname', 'id')->toArray();
        return view('employees.show', compact('employee', 'leaders', 'posts', 'users'));
    }

    public function sign(Employee $employee, $company)
    {
        $outputPath = $this->signService->generate($employee, $company);
        return redirect($outputPath);
    }

    public function update(Employee $employee, Request $request)
    {
        $employee->fullname = $request->fullname;
        $employee->work_phone = $request->work_phone;
        $employee->birthday = empty($request->birthday) ? null : \Carbon::parse($request->birthday)->format('Y-m-d');
        $employee->description = $request->description;
        $employee->email = $request->email;
        $employee->email2 = $request->email2;
        $employee->phone_number = $request->phone_number;
        $employee->post_id = $request->post_id;
        $employee->leader_id = $request->leader_id;
        $employee->update();

        if (auth()->user()->hasPermission('users')) {
            $users = User::where('employee_id', $employee->id)->get();
            foreach ($users as $user) {
                $user->employee_id = null;
                $user->update();
            }

            if (!is_null($request->username)) {
                $user = User::find($request->username);
                $user->employee_id = $employee->id;
                $user->update();
            }
        }

        $filename = $this->uploader->upload(
            $request->file('avatar_url'),
            Employee::getDestinationPath()
        );

        if (!is_null($filename)) {
            $employee->avatar_url = $filename;
            $employee->update();
        }

        return redirect()->back();
    }
}
