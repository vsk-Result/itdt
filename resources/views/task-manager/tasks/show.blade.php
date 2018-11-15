<div class="d-flex flex-md-row mb-2">
    <div class="form-check form-check-switchery">
        <label class="form-check-label">
            <input id="switch-edit" type="checkbox" class="form-check-input-switchery-primary" data-fouc>
            Режим редактирования
        </label>
    </div>
</div>

<div class="d-flex align-items-start flex-column flex-md-row">
    @include('task-manager.partials.info_general')
    @include('task-manager.partials.info_sidebar')
</div>

<div id="comments" style="display: none;">
    @include('task-manager.subtasks.comments')
</div>
