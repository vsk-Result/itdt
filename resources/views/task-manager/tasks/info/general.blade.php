<div class="card">
    @include('task-manager.tasks.stock', compact('task'))
</div>

<div id="subtasks-container">
    @include('task-manager.tasks.info.subtasks')
</div>
