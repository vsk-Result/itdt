<div class="card">
    <div class="card-header header-elements-inline">
        @isset($subtask)
            <h5 class="card-title">Комментарии подзадачи <b>"{{ $subtask->name }}"</b></h5>
        @endisset
    </div>

    <div class="card-body">
        <div class="mb-4">
            @isset($subtask)
                <input id="comment-body" type="text" class="form-control" placeholder="Напишите сообщение..." data-send-url="{{ route('tasks.subtasks.comments.send_message', $subtask->id) }}">
                @each('task-manager.subtasks.partials.comment', $subtask->getLastComments(), 'comment')
            @endisset
        </div>
    </div>
</div>