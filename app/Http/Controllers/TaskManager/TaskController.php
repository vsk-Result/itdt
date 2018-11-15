<?php

namespace App\Http\Controllers\TaskManager;

use App\Models\TaskManager\Attachment;
use App\Models\TaskManager\Priority;
use App\Models\TaskManager\Status;
use App\Models\TaskManager\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        return view('task-manager.tasks.index');
    }

    public function all()
    {
        $tasks = Task::orderBy('status_id', 'ASC')->with('priority', 'status', 'user', 'subtasks', 'checkedSubtasks')->get();
        $tasks_render = view('task-manager.tasks.partials.all', compact('tasks'))->render();
        return response()->json(compact('tasks_render'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $priorities = Priority::all();
        $statuses = Status::pluck('name', 'id');
        $info_render = view('task-manager.tasks.show', compact('task', 'priorities', 'statuses'))->render();
        return response()->json(compact('info_render'));
    }

    public function store()
    {
        $task = new Task();
        $task->user_id = auth()->id();
        $task->priority_id = 2;
        $task->status_id = 1;
        $task->name = 'НОВАЯ ЗАДАЧА';
        $task->description = '';
        $task->save();

        return response()->json(['status' => 'success']);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $task_render = view('task-manager.tasks.edit', compact('task'))->render();
        return response()->json(compact('task_render'));
    }

    public function update($id, Request $request)
    {
        $task = Task::findOrFail($id);

        if (isset($request->priority_id) || isset($request->status_id)) {
            $task->priority_id = isset($request->priority_id) ? $request->priority_id : $task->priority_id;
            $task->status_id = isset($request->status_id) ? $request->status_id : $task->status_id;
            $task->updated_at = Carbon::now();
            $task->update();
            $priorities = Priority::all();
            $statuses = Status::pluck('name', 'id');
            $task_details = view('task-manager.tasks.info.details', compact('task', 'priorities', 'statuses'))->render();
            return response()->json(compact('task_details'));
        }

        $task->name = $request->name;
        $task->description = $request->description;
        $task->updated_at = Carbon::now();
        $task->update();

        $task_render = view('task-manager.tasks.stock', compact('task'))->render();
        return response()->json(compact('task_render'));
    }

    public function cancelEdit($id)
    {
        $task = Task::findOrFail($id);
        $task_render = view('task-manager.tasks.stock', compact('task'))->render();
        return response()->json(compact('task_render'));
    }

    public function attachFiles($id, Request $request)
    {
        $task = Task::findOrFail($id);
        $task_attachments = $request->file('task_attachments');

        if (is_array($task_attachments) && count($task_attachments) > 0 && $task_attachments[0] != null) {
            for ($i = 0; $i < count($task_attachments); $i++) {

                $file = $task_attachments[$i];
                $filename = $task->id . '_' . str_random(2) . '_' . rus2translit($file->getClientOriginalName());
                $file->storeAs($task->getDestinationPath(), $filename);

                $attachment = new Attachment();
                $attachment->user_id = auth()->id();
                $attachment->task_id = $task->id;
                $attachment->filename = $filename;
                $attachment->save();
            }
        }

        $attachments_render = view('task-manager.tasks.info.attachments', compact('task'))->render();
        return response()->json(compact('attachments_render'));
    }
}