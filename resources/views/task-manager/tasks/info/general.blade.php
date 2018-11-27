<div id="task-general-info"
     class="card"
     data-edit-url="{{ route('tasks.edit', $task->id) }}"
     data-show-url="{{ route('tasks.show', $task->id) }}">
</div>

@include('task-manager.tasks.info.subtasks')
