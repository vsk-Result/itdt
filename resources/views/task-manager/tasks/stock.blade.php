<div class="card-header header-elements-md-inline">
    <h5 class="card-title">Задача #{{$task->id}}: {{ $task->name }}</h5>
    <div class="header-elements">
        <a style="display: none;" href="javascript:void(0)" class="task-name-edit ml-2" title="Изменить название и описание задачи" data-name-edit-url="{{ route('tasks.edit', $task->id) }}"><i class="icon-pencil3 font-size-sm"></i></a>
    </div>
</div>

<div class="card-body">
    <span class="text-muted">{{ $task->type->name }}</span>
</div>