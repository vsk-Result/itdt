<div class="card-body">
    <div class="mb-2 w-100">
        <h6 class="font-weight-semibold">Название задачи</h6>
        {{ Form::text('task_name', $task->name, ['id' => 'task-name', 'class' => 'form-control']) }}
    </div>
    <div class="w-100">
        <h6 class="font-weight-semibold">Информация</h6>
        {{ Form::textarea('description', $task->description, ['id' => 'task-description', 'class' => 'form-control', 'rows' => 5]) }}
    </div>
</div>