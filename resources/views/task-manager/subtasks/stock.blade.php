<ul class="media-list media-list-linked">
    @forelse($task->subtasks as $subtask)
        <li class="media">
            <div class="mr-3">
                {{ Form::checkbox('check', null, $subtask->checked, ['class' => 'form-check-input-styled', 'data-info-url' => route('tasks.subtasks.update', $subtask->id)]) }}
            </div>

            <div class="media-body">
                <span class="subtask-name  {{ $subtask->checked ? 'text-line-through' : '' }}">{{ $subtask->name }}</span>
            </div>

            <div class="ml-3">
                <div class="list-icons">
                    <a href="#" class="list-icons-item subtask-comments position-relative" data-comments-url="{{ route('tasks.subtasks.comments.index', $subtask->id) }}">
                        <i class="icon-comments"></i>
                        <span>{{ $subtask->comments->count() }}</span>
                    </a>
                </div>
            </div>
        </li>
    @empty
        <p>Записи отсутствуют</p>
    @endforelse
</ul>