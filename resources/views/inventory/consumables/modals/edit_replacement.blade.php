<div id="editReplacement" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Изменение записи о замене расходного материала</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{ Form::open(['url' => '', 'method' => 'PUT', 'id' => 'edit-replacement-form']) }}
                <div class="form-group">
                    <label>Принтер</label>
                    {{ Form::select('printer_id', $printers, null, ['class' => 'form-control select', 'id' => 'replacement-printer']) }}
                </div>
                <div class="form-group">
                    <label>Дата замены</label>
                    {{ Form::date('replaced_at', null, ['class' => 'form-control date', 'id' => 'replacement-replaced-date']) }}
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    {{ Form::text('comment', null, ['class' => 'form-control', 'id' => 'replacement-comment']) }}
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>