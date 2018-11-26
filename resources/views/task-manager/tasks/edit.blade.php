<div class="card-body">
    <div class="mb-2 w-100">
        <h6 class="font-weight-semibold">Название задачи</h6>
        {{ Form::text('task_name', $task->name, ['id' => 'task-name', 'class' => 'form-control']) }}
    </div>
    <div class="w-100">
        <h6 class="font-weight-semibold">Тип задачи</h6>
        {{ Form::select('type_id', $types, $task->type_id, ['id' => 'task-type', 'class' => 'form-control']) }}
    </div>
</div>
<div class="card-footer bg-white d-flex justify-content-between align-items-center">
    <div></div>
    <div class="list-icons">
        <a class="list-icons-item apply-task-edit mr-2 cursor-pointer" data-apply-url="{{ route('tasks.update', $task->id) }}"><i class="text-green icon-checkmark4"></i></a>
        <a class="list-icons-item cancel-task-edit cursor-pointer" data-cancel-url="{{ route('tasks.cancel_edit', $task->id) }}"><i class="text-danger icon-cross2"></i></a>
    </div>
</div>