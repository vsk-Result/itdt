<div id="createPrinterModel" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Новая модель принтера</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{ Form::open(['url' => route('inventory.printer_models.store'), 'method' => 'POST']) }}
                <div class="form-group">
                    <label>Название</label>
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>