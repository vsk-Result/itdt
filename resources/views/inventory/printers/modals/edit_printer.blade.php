<div id="editPrinter" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Изменение данных принтер</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{ Form::open(['url' => '', 'method' => 'PUT', 'id' => 'edit-printer-form']) }}
                <div class="form-group">
                    <label>Модель принтера</label>
                    {{ Form::select('model_id', $printer_models_list, null, ['class' => 'form-control select', 'id' => 'printer-model']) }}
                </div>
                <div class="form-group">
                    <label>Объект</label>
                    {{ Form::select('object_id', $objects, null, ['class' => 'form-control select', 'id' => 'printer-object']) }}
                </div>
                <div class="form-group">
                    <label>Инвентарный номер + Наименование</label>
                    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'printer-name']) }}
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    {{ Form::text('description', null, ['class' => 'form-control', 'id' => 'printer-description']) }}
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>