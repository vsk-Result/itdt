<div id="createCategory" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Новая категория</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{ Form::open(['url' => route('knowledge.categories.store'), 'method' => 'POST']) }}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Иконка</label><br>
                            {{ Form::hidden('icon_id', null, ['class' => 'input-icon']) }}
                            <button type="button" class="btn btn-light choose-icon"><i class="mr-2"></i> Выбрать иконку</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Название</label>
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => true]) }}
                        </div>
                    </div>
                </div>

                <div class="icons-container" style="display: none;"></div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>