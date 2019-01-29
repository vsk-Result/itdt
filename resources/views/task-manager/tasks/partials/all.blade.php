<table class="table tasks-list table-lg table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Статус</th>
        <th>Задача</th>
        <th>Выполнение</th>
        <th>Автор</th>
        <th>Объект</th>
    </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
            <tr class="open-modal-task" data-task-info-url="{{ route('tasks.info', $task->id) }}">
                <td class="priority-{{ $task->priority->class }}">#{{ $task->id }}</td>
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
                <td>
                    {{ $task->user->name }}
                </td>
                <td>
                    {{ $task->object ? $task->object->getFullName() : '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>