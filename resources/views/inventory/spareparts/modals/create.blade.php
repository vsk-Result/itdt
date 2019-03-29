<div id="createSparepart" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Новая запчасть</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{ Form::open(['url' => route('inventory.spareparts.store'), 'method' => 'POST']) }}
                <div class="form-group">
                    <label>Модель принтера</label>
                    {{ Form::select('model_id', $printer_models_list, null, ['class' => 'form-control select']) }}
                </div>
                <div class="form-group">
                    <label>Название</label>
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Номер изделия</label>
                    {{ Form::text('part_number', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Ссылка</label>
                    {{ Form::text('url', null, ['class' => 'form-control']) }}
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>