<table class="table tasks-list table-lg table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Статус</th>
        <th>Задача</th>
        <th>Выполнение</th>
        <th>Приоритет</th>
        <th>Автор</th>
        <th>Последнее изменение</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr class="open-modal-task" data-task-info-url="{{ route('tasks.show', $task->id) }}">
            <td>#{{ $task->id }}</td>
            <td>{{ $task->status->name }}</td>
            <td>
                <div class="font-weight-semibold"><a href="#">{{ $task->name }}</a></div>
                <div class="text-muted">{{ $task->description }}</div>
            </td>
            <td>
                <div class="progress rounded-round">
                    <div class="progress-bar bg-success" style="width: {{ $task->getCompletePercentage() }}%">
                        <span>{{ $task->getCompletePercentage() }}%</span>
                    </div>
                </div>
            </td>
            <td>
                <span class="badge bg-{{ $task->priority->class }}">{{ $task->priority->name }}</span>
            </td>
            <td>{{ $task->user->name }}</td>
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