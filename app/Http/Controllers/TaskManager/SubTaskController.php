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
        $subtask->name = Subtask::getDefaultName();
        $subtask->save();

        $subtask_render = view('task-manager.subtasks.partials.edit_subtask', compact('subtask'))->render();
        return response()->json(compact('subtask_render'));
    }

    public function update($id, Request $request)
    {
        $subtask = Subtask::findOrFail($id);
        $subtask->checked = $request->checked == "true" ? 1 : 0;
        $subtask->updated_at = Carbon::now();
        $subtask->update();

        return response()->json(['status' => 'success']);
    }

    public function destroy($id) {
        $subtask = Subtask::findOrFail($id);
        $task = $subtask->task;
        $subtask->delete();

        return response()->json(['status' => 'success']);
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