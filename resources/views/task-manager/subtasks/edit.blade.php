<ul class="media-list list-edit">
    @each('task-manager.subtasks.partials.edit_subtask', $task->subtasks, 'subtask')
</ul>