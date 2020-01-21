<?php

namespace App\Http\Controllers\TaskManager;

use App\Models\TaskManager\Priority;
use App\Models\TaskManager\Subtask;
use App\Models\TaskManager\SubtaskComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\TaskManager\CommentService;
use App\UseCases\TaskManager\SubtaskService;

class CommentController extends Controller
{
    private $commentservice;
    private $subtaskservice;

    public function __construct(CommentService $commentservice, SubtaskService $subtuskservice)
    {
        $this->middleware('permission:task_manager');
        $this->commentservice = $commentservice;
        $this->subtaskservice = $subtuskservice;
    }

    public function comments($id) {
        $comments_render = $this->commentservice->comments($id);

        return response()->json(compact('comments_render'));
    }

    public function destroyComment($id) {
        $comments_count = $this->commentservice->destroy($id);

        return response()->json(compact('comments_count'));
    }

    public function sendMessage($id, Request $request) {
        $subtask = $this->subtaskservice->find($id);
        $this->commentservice->storeComment($id,  $request->text);
        $comments_count = $this->subtaskservice->comments($subtask);
        $comments_render = view('task-manager.subtasks.comments', compact('subtask'))->render();
        return response()->json(compact('comments_render', 'comments_count'));
    }
}
