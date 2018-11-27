<div class="card">
    <div class="card-header header-elements-md-inline">
        <h5 class="card-title">Подзадачи</h5>
        <div class="header-elements">
            <button title="Добавить подзадачу" type="button" id="add-subtask" class="btn btn-sm bg-success-400 btn-icon rounded-round" data-add-url="{{ route('tasks.subtasks.store', $task->id) }}">
                <i class="icon-plus2"></i>
            </button>
        </div>
    </div>

    <div id="subtasks-container"
         class="card-body"
         data-edit-url="{{ route('tasks.subtasks.edit', $task->id) }}"
         data-show-url="{{ route('tasks.subtasks.show', $task->id) }}">
    </div>
</div>