<ul class="media-list media-list-linked">
    @foreach($task->subtasks as $subtask)
        <li class="media">
            <div class="mr-3">
                {{ Form::checkbox('check', null, $subtask->checked, ['class' => 'form-check-input-styled', 'data-info-url' => route('tasks.subtasks.update', $subtask->id)]) }}
            </div>

            <div class="media-body">
                <span class="subtask-name  {{ $subtask->checked ? 'text-line-through' : '' }}">{{ $subtask->name }}</span>
            </div>

            <div class="ml-3">
                <div class="list-icons">
                    <a href="#" class="list-icons-item subtask-comments" data-comments-url="{{ route('tasks.subtasks.comments.index', $subtask->id) }}">
                        <i class="icon-comment-discussion"></i>
                    </a>
                </div>
            </div>
        </li>
    @endforeach
</ul>