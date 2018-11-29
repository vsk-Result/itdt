<table class="table tasks-list table-lg table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Статус</th>
        <th>Задача</th>
        <th>Выполнение</th>
        <th>Приоритет</th>
        <th class="text-center">Автор</th>
        <th>Последнее изменение</th>
    </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
            <tr class="open-modal-task" data-task-info-url="{{ route('tasks.info', $task->id) }}">
                <td>#{{ $task->id }}</td>
                <td>{{ $task->status->name }}</td>
                <td>
                    <div class="font-weight-semibold">
                        @if (!$task->isTaskType())
                            <span title="{{ $task->type->name }}" class="mr-1 {{ $task->type->color }}"><i class="icon font-size-sm {{ $task->type->icon }}"></i></span>
                        @endif

                        <a href="#">{{ $task->name }}</a>
                    </div>
                </td>
                <td>
                    @if ($task->subtasks->count() > 0)
                        @php
                            $percentage = $task->getCompletePercentage();
                        @endphp
                        <div class="w-auto h-auto">
                            <div class="theme_bar_lg">
                                <div class="pace_progress"
                                     data-progress-text="{{ $percentage }}%"
                                     data-progress="{{ $percentage }}"
                                     style="width: {{ $percentage }}%;">
                                </div>
                                <span>{{ $task->getCompletePercentage(true) . ' (' . $percentage . '%)' }}</span>
                            </div>
                        </div>
                    @endif
                </td>
                <td align="center">
                    <span class="badge bg-{{ $task->priority->class }}">{{ $task->priority->name }}</span>
                </td>
                <td align="center">{{ $task->user->name }}</td>
                <td>
                    <div class="d-inline-flex align-items-center">
                        <i class="icon-calendar2 mr-2"></i>
                        <span>{{ $task->updated_at->diffForHumans() }}</span>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>