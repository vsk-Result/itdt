<li class="media" data-id="{{ $subtask->id }}">
    <div class="media-body">
        {{ Form::text('name', $subtask->name, ['class' => 'form-control form-control-sm']) }}
    </div>

    <div class="ml-3 mt-1">
        <div class="list-icons">
            <span class="destroy-subtask text-danger cursor-pointer" data-destroy-url="{{ route('tasks.subtasks.destroy', $subtask->id) }}">
                <i class="icon-trash"></i>
            </span>
        </div>
    </div>
</li>