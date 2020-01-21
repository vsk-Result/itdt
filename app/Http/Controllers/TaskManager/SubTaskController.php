<?php

namespace App\Http\Controllers\TaskManager;

use App\Models\TaskManager\Priority;
use App\Models\TaskManager\Status;
use App\Models\TaskManager\Subtask;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\TaskManager\CommentService;
use Carbon\Carbon;

class SubTaskController extends Controller
{
    private $commentservice;
    
    public function __construct(CommentService $commentservice)
    {
        $this->middleware('permission:task_manager');
        $this->commentservice = $commentservice;
    }

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

        if ($request->checked == "true") {
            $comment = $this->storeComment($id, 'Пользователь выполнил подзадачу');
        } else {
            $comment = $this->storeComment($id, 'Пользователь отменил выполнение подзадачи');
        }

        return response()->json(['status' => 'success']);
    }

    public function destroy($id) {
        $subtask = Subtask::findOrFail($id);
        $subtask->delete();

        return response()->json(['status' => 'success']);
    }

    public function storeComment($subtask_id, $text)
    {
        $comment = $this->commentservice->storeComment($subtask_id, $text);

        return $comment;
    }
}
