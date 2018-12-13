<div class="card">
    <div class="card-header header-elements-md-inline">
        <h5 class="card-title">Чек-лист</h5>
        <div class="header-elements">
            @if (auth()->id() == $task->user_id)
                <button title="Добавить подзадачу" type="button" id="add-subtask" class="btn btn-sm bg-success-400 btn-icon rounded-round" data-add-url="{{ route('tasks.subtasks.store', $task->id) }}">
                    <i class="icon-plus2"></i>
                </button>
            @endif
        </div>
    </div>

    <div id="subtasks-container"
         class="card-body"
         data-edit-url="{{ route('tasks.subtasks.edit', $task->id) }}"
         data-show-url="{{ route('tasks.subtasks.show', $task->id) }}">
    </div>
</div>