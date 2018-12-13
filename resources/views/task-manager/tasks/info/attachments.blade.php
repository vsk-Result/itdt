<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="text-uppercase font-size-sm font-weight-semibold">Вложения</span>
    </div>

    <div class="card-body">
        {{ Form::open(['url' => '', 'id' => 'formdata', 'files' => true, 'data-url' => route('tasks.attach_files', $task->id), 'style' => 'display: none;']) }}
        <input id="task-attachments-input" type="file" name="task_attachments[]" multiple="multiple">
        {{ Form::close() }}
        <ul class="media-list mt-3">
            @forelse($task->attachments as $attachment)
                <li class="media">
                    <div class="mr-3 align-self-center">
                        {!! $attachment->getIcon() !!}
                    </div>

                    <div class="media-body">
                        <div class="font-weight-semibold">
                            {{ $attachment->getFilename() }}
                            <span class="destroy-attachment text-danger cursor-pointer important" data-destroy-url="{{ route('tasks.attach_files.destroy', [$task->id, $attachment->id]) }}">(<i class="icon-trash font-size-xs"></i>)</span>
                        </div>
                        <ul class="list-inline list-inline-dotted list-inline-condensed font-size-sm text-muted">
                            <li class="list-inline-item">Размер: {{ $attachment->getSize() }}</li>
                            <li class="list-inline-item">{{ $attachment->user->name }}</li>
                            <li class="list-inline-item">{{ $attachment->created_at->format('d/m/Y H:i') }}</li>
                        </ul>
                    </div>

                    <div class="ml-3">
                        <div class="list-icons">
                            <a href="{{ $attachment->getUrl() }}" class="list-icons-item"><i class="icon-download"></i></a>
                        </div>
                    </div>
                </li>
            @empty
                Вложений нет
            @endforelse
        </ul>
    </div>
</div>