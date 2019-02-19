<div id="editConsumable" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Изменение данных расходного материала</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{ Form::open(['url' => '', 'method' => 'PUT', 'id' => 'edit-consumable-form']) }}
                <div class="form-group">
                    <label>Название</label>
                    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'consumable-name']) }}
                </div>
                <div class="form-group">
                    <label>Цвет</label>
                    {{ Form::select('color_id', $colors, null, ['class' => 'form-control select', 'id' => 'consumable-color']) }}
                </div>
                <div class="form-group">
                    <label>Модели совместимых принтеров</label>
                    {{ Form::select('printers[]', $printer_models_list, null, ['class' => 'form-control select', 'multiple' => 'multiple', 'id' => 'consumable-printers']) }}
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>