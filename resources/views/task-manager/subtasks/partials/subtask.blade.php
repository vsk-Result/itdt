<div class="subtask-container stock p-1 mb-1" data-comments-url="{{ route('tasks.subtasks.comments.index', $subtask->id) }}">
    @include('task-manager.subtasks.stock', compact('subtask'))
</div>