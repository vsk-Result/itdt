<div class="form-check">
    <label class="form-check-label">
        {{ Form::checkbox('check', null, $subtask->checked, ['class' => 'form-check-input-styled', 'data-info-url' => route('tasks.subtasks.update', $subtask->id)]) }}
        <span class="subtask-name  {{ $subtask->checked ? 'text-line-through' : '' }}">{{ $subtask->name }}</span>
        <a style="display: none;" href="javascript:void(0)" class="subtask-edit ml-2" title="Изменить название подзадачи" data-edit-url="{{ route('tasks.subtasks.edit', $subtask->id) }}"><i class="icon-pencil3 font-size-sm"></i></a>
        <a style="display: none;" href="javascript:void(0)" class="subtask-destroy ml-2" title="Удалить подзадачу" data-destroy-url="{{ route('tasks.subtasks.destroy', $subtask->id) }}"><i class="icon-cross2 text-danger font-size-sm"></i></a>
    </label>
</div>