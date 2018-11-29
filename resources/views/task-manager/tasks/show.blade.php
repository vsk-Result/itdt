<div class="d-flex flex-md-row mb-2">
    @if (auth()->id() == $task->user_id)
        <div class="form-check form-check-switchery">
            <label class="form-check-label">
                <input id="switch-edit" type="checkbox" class="form-check-input-switchery form-check-input-switchery-primary" data-fouc>
                Режим редактирования
            </label>
        </div>
    @endif
</div>

<div class="d-flex align-items-start flex-column flex-md-row">
    @include('task-manager.partials.info_general')
    @include('task-manager.partials.info_sidebar')
</div>
