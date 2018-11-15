<div class="input-group">
    {{ Form::text('name', $subtask->name, ['class' => 'form-control form-control-sm']) }}
    <span class="input-group-append">
        <button class="btn btn-sm btn-success apply-edit" data-apply-url="{{ route('tasks.subtasks.update', $subtask->id) }}" type="button"><i class="icon-checkmark2"></i></button>
        <button class="btn btn-sm btn-danger cancel-edit" data-cancel-url="{{ route('tasks.subtasks.cancel_edit', $subtask->id) }}"type="button"><i class="icon-cross2"></i></button>
    </span>
</div>