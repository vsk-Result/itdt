<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="text-uppercase font-size-sm font-weight-semibold">Детали задачи</span>
    </div>

    <table id="task-info-table" class="table table-borderless table-xs my-2" data-task-update-url="{{ route('tasks.update', $task->id) }}">
        <tbody>
        <tr>
            <td><i class="icon-circles2 mr-2"></i> Приоритет:</td>
            <td class="text-right">
                <div class="btn-group">
                    <a href="javascript:void(0)" class="badge bg-{{ $task->priority->class }} dropdown-toggle" data-toggle="dropdown">{{ $task->priority->name }}</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($priorities as $priority)
                            <a href="javascript:void(0)" class="task-priority dropdown-item {{ $priority->id == $task->priority_id ? 'active' : '' }}" data-priority-id="{{ $priority->id }}">
                                <span class="badge badge-mark mr-2 bg-{{ $priority->class }} border-{{ $priority->class }}"></span>
                                {{ $priority->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td><i class="icon-file-check mr-2"></i> Тип:</td>
            <td class="text-right">
                {{ Form::select('task_type', $types, $task->type_id, ['id' => 'task-type', 'class' => 'form-control form-control-sm']) }}
            </td>
        </tr>
        <tr>
            <td><i class="icon-file-check mr-2"></i> Статус:</td>
            <td class="text-right">
                {{ Form::select('task_status', $statuses, $task->status_id, ['id' => 'task-status', 'class' => 'form-control form-control-sm']) }}
            </td>
        </tr>
        <tr>
            <td><i class="icon-file-plus mr-2"></i> Создал:</td>
            <td class="text-right"><a href="#">{{ $task->user->name }}</a></td>
        </tr>
        <tr>
            <td><i class="icon-alarm-check mr-2"></i> Изменено:</td>
            <td class="text-right text-muted">{{ $task->updated_at->format('d.m.Y H:i') }}</td>
        </tr>
        <tr>
            <td><i class="icon-alarm-add mr-2"></i> Создано:</td>
            <td class="text-right text-muted">{{ $task->created_at->format('d.m.Y H:i') }}</td>
        </tr>
        </tbody>
    </table>
</div>