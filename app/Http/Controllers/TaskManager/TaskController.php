<?php

namespace App\Http\Controllers\TaskManager;

use App\Models\Objects\CObject;
use App\Models\TaskManager\Attachment;
use App\Models\TaskManager\Priority;
use App\Models\TaskManager\Status;
use App\Models\TaskManager\Subtask;
use App\Models\TaskManager\SubtaskComment;
use App\Models\TaskManager\Task;
use App\Models\TaskManager\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $types = Type::all();
        $statuses = Status::all();
        $priorities = Priority::all();
        $authors = Task::getAuthorsList();
        $objects = Task::getObjectsList();
        $sorts = ['id' => 'ID', 'name' => 'Название'];
        return view('task-manager.tasks.index', compact('priorities', 'statuses', 'types', 'objects', 'authors', 'objects', 'sorts'));
    }

    public function all(Request $request)
    {
        if (strlen($request->search_text) > 3) {
            $query = $request->search_text;

            $one_search = Task::where('name', 'LIKE', '%' . $query . '%')->orWhere('description', 'LIKE', '%' . $query . '%')->pluck('id')->toArray();
            $two_search = Subtask::where('name', 'LIKE', '%' . $query . '%')->pluck('task_id')->toArray();
            $three_search = SubtaskComment::where('text', 'LIKE', '%' . $query . '%')->pluck('subtask_id')->toArray();
            $three_search = Subtask::whereIn('id', $three_search)->pluck('task_id')->toArray();

            $task_ids = array_merge($one_search, $two_search, $three_search);
            $tasks = Task::whereIn('id', $task_ids)->orderBy('status_id')->with('object', 'priority', 'status', 'user', 'type', 'subtasks', 'checkedSubtasks')->get();

            $tasks_render = view('task-manager.tasks.partials.all', compact('tasks'))->render();
            return response()->json(compact('tasks_render'));
        }

        $query = Task::query();

        if ($request->filter_type != 'all') {
            $query->where('type_id', $request->filter_type);
        }
        if ($request->filter_status != 'all') {
            $query->where('status_id', $request->filter_status);
        }
        if ($request->filter_priority != 'all') {
            $query->where('priority_id', $request->filter_priority);
        }
        if ($request->filter_author != 'all') {
            $query->where('user_id', $request->filter_author);
        }
        if ($request->filter_object != 'all') {
            $query->where('object_id', $request->filter_object);
        }
        if ($request->is_only_me == "true") {
            $query->where('user_id', auth()->id());
        }

        if ($request->sorting == 'all') {
            $query->orderBy('status_id')->orderBy('priority_id')->orderBy('id', 'desc');
        } else {
            $query->orderBy('status_id')->orderBy($request->sorting, $request->sort_dir);
        }

        $tasks = $query->with('object', 'priority', 'status', 'user', 'type', 'subtasks', 'checkedSubtasks')->get();
        $tasks_render = view('task-manager.tasks.partials.all', compact('tasks'))->render();
        return response()->json(compact('tasks_render'));
    }

    public function show($id, Request $request)
    {
        $task = Task::findOrFail($id);

        if (!empty($request->name)) {
            $task->name = $request->name;
            $task->description = $request->description;
            $task->update();
        }

        $task_render = view('task-manager.tasks.stock', compact('task'))->render();
        return response()->json(compact('task_render'));
    }

    public function info($id)
    {
        $task = Task::findOrFail($id);
        $priorities = Priority::all();
        $statuses = Status::pluck('name', 'id');
        $objects = CObject::getList();
        $types = Type::pluck('name', 'id');
        $info_render = view('task-manager.tasks.show', compact('task', 'priorities', 'statuses', 'types', 'objects'))->render();
        return response()->json(compact('info_render'));
    }

    public function store()
    {
        $task = new Task();
        $task->user_id = auth()->id();
        $task->priority_id = Priority::DEFAULT_ID;
        $task->status_id = Status::DEFAULT_ID;
        $task->type_id = Type::DEFAULT_ID;
        $task->object_id = null;
        $task->name = Task::getDefaultName();
        $task->save();

        $info_url = route('tasks.info', $task->id);

        return response()->json(compact('info_url'));
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

        if (isset($request->priority_id) || isset($request->status_id) || isset($request->type_id) || (isset($request->is_object))) {
            $task->priority_id = isset($request->priority_id) ? $request->priority_id : $task->priority_id;
            $task->status_id = isset($request->status_id) ? $request->status_id : $task->status_id;
            $task->type_id = isset($request->type_id) ? $request->type_id : $task->type_id;
            $task->object_id = (isset($request->object_id) && isset($request->is_object)) ? $request->object_id : $task->object_id;
            $task->updated_at = Carbon::now();

            if (isset($request->status_id) && $request->status_id == Task::COMPLETE_STATUS_ID) {
                $task->completed_at = Carbon::now();
                $task->user_complete_id = auth()->id();
            } else {
                $task->completed_at = null;
                $task->user_complete_id = null;
            }

            $task->update();
            $priorities = Priority::all();
            $statuses = Status::pluck('name', 'id');
            $objects = CObject::getList();
            $types = Type::pluck('name', 'id');
            $task_details = view('task-manager.tasks.info.details', compact('task', 'priorities', 'statuses', 'types', 'objects'))->render();
            return response()->json(compact('task_details'));
        }

        $task->name = $request->name;
        $task->type_id = $request->type;
        $task->updated_at = Carbon::now();
        $task->update();

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

    public function destroyFile($id, $f_id)
    {
        $attachment = Attachment::findOrFail($f_id);
        $attachment->delete();

        return response()->json(['status' => 'success']);
    }

    public function getEdit($id)
    {
        $task = Task::findOrFail($id);
        $subtasks_render = view('task-manager.subtasks.edit', compact('task'))->render();
        return response()->json(compact('subtasks_render'));
    }

    public function getShow($id, Request $request)
    {
        if (isset($request->subtasks_info)) {
            foreach ($request->subtasks_info as $info) {
                $info_array = explode('***', $info);
                $subtask = Subtask::findOrFail($info_array[0]);
                $subtask->name = $info_array[1];
                $subtask->updated_at = Carbon::now();
                $subtask->update();
            }
        }

        $task = Task::findOrFail($id);
        $subtasks_render = view('task-manager.subtasks.stock', compact('task'))->render();
        return response()->json(compact('subtasks_render'));
    }
}