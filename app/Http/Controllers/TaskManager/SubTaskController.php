<?php

namespace App\Http\Controllers\TaskManager;

use App\Models\TaskManager\Priority;
use App\Models\TaskManager\Status;
use App\Models\TaskManager\Subtask;
use App\Models\TaskManager\SubtaskComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SubTaskController extends Controller
{
    public function store($id)
    {
        $subtask = new Subtask();
        $subtask->task_id = $id;
        $subtask->name = 'Без названия';
        $subtask->save();

        $task = $subtask->task;
        $subtasks_render = view('task-manager.tasks.info.subtasks', compact('task'))->render();
        return response()->json(compact('subtasks_render'));
    }

    public function edit($id)
    {
        $subtask = Subtask::findOrFail($id);
        $subtask_render = view('task-manager.subtasks.edit', compact('subtask'))->render();
        return response()->json(compact('subtask_render'));
    }

    public function update($id, Request $request)
    {
        $subtask = Subtask::findOrFail($id);
        if (isset($request->checked)) {
            $subtask->checked = $request->checked == "true" ? 1 : 0;
        }
        if (isset($request->name)) {
            $subtask->name = $request->name;
        }
        $subtask->updated_at = Carbon::now();
        $subtask->update();

        if (isset($request->name)) {
            $subtask_render = view('task-manager.subtasks.stock', compact('subtask'))->render();
            return response()->json(compact('subtask_render'));
        }

        return response()->json(['status' => 'success']);
    }

    public function cancelEdit($id)
    {
        $subtask = Subtask::findOrFail($id);
        $subtask_render = view('task-manager.subtasks.stock', compact('subtask'))->render();
        return response()->json(compact('subtask_render'));
    }

    public function destroy($id) {
        $subtask = Subtask::findOrFail($id);
        $task = $subtask->task;
        $subtask->delete();

        $subtasks_render = view('task-manager.tasks.info.subtasks', compact('task'))->render();
        return response()->json(compact('subtasks_render'));
    }

    public function comments($id) {
        $subtask = Subtask::findOrFail($id);
        $comments_render = view('task-manager.subtasks.comments', compact('subtask'))->render();
        return response()->json(compact('comments_render'));
    }

    public function sendMessage($id, Request $request) {
        $subtask = Subtask::findOrFail($id);
        $comment = new SubtaskComment();
        $comment->subtask_id = $id;
        $comment->user_id = auth()->id();
        $comment->text = $request->text;
        $comment->save();
        $subtask->update();

        $comments_render = view('task-manager.subtasks.comments', compact('subtask'))->render();
        return response()->json(compact('comments_render'));
    }
}