<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="text-uppercase font-size-sm font-weight-semibold">Вложения</span>
    </div>

    <div class="card-body pt-0">
        {{ Form::open(['url' => '', 'id' => 'formdata', 'files' => true, 'data-url' => route('tasks.attach_files', $task->id), 'style' => 'display: none;', 'class' => 'mt-2']) }}
        <input id="task-attachments-input" type="file" name="task_attachments[]" multiple="multiple">
        {{ Form::close() }}
        <ul class="media-list mt-3">
            @forelse($task->attachments as $attachment)
                <li class="media">
                    <div class="mr-3 align-self-center">
                        {!! $attachment->getIcon() !!}
                    </div>

                    <div class="media-body">
                        <div class="font-weight-semibold">{{ $attachment->getFilename() }}</div>

                        <ul class="list-inline list-inline-condensed mb-0">
                            <li class="list-inline-item">
                                <a class="popover-info" href="#" data-popup="tooltip" data-html="true" data-content="<ul class='font-size-sm text-muted pl-0 mb-0'><li class='list-inline-item'>Автор: {{ $attachment->user->name }}</li><li class='list-inline-item'>Дата загрузки: {{ $attachment->created_at->format('d/m/Y H:i') }}</li><li class='list-inline-item'>Размер: {{ $attachment->getSize() }}</li>">Инфо</a>
                            </li>
                            <li class="list-inline-item">
                                <a target="_blank" href="{{ $attachment->getUrl() }}">Открыть</a>
                            </li>
                            <li class="list-inline-item destroy-attachment" data-destroy-url="{{ route('tasks.attach_files.destroy', [$task->id, $attachment->id]) }}">
                                <a class="text-danger" href="{{ $attachment->getUrl() }}">Удалить</a>
                            </li>
                            </li>
                        </ul>
                    </div>
                </li>
            @empty
                Вложений нет
            @endforelse
        </ul>
    </div>
</div>