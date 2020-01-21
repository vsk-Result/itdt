<?php

namespace App\UseCases\TaskManager;

use App\Models\TaskManager\SubtaskComment;
use App\Models\TaskManager\Subtask;

class CommentService
{

    public function storeComment($subtask_id, $text)
    {
        $comment = new SubtaskComment();
        $comment->subtask_id = $subtask_id;
        $comment->user_id = auth()->id();
        $comment->text = $text;
        $comment->save();

        return $comment;
    }

    public function destroy($id)
    {
        $comment = SubtaskComment::findOrFail($id);
        $subtask = $comment->subtask;
        $comment->delete();
        $comments_count = $subtask->comments->count();

        return $comments_count;
    }

    public function comments($id)
    {
        $subtask = Subtask::findOrFail($id);
        $comments_render = view('task-manager.subtasks.comments', compact('subtask'))->render();

        return $comments_render;
    }

    public function sendMessage($id, Request $request)
    {
        $subtask = Subtask::findOrFail($id);
        $comment = $this->storeComment($id, $request->text);
        $subtask->update();

        return $subtask;
    }
}
