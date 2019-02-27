<div id="editMovement" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Изменение записи о движении расходного материала</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{ Form::open(['url' => '', 'method' => 'PUT', 'id' => 'edit-movement-form']) }}
                <div class="form-group sender-select">
                    <label>Пункт отправки</label>
                    {{ Form::select('sender_id', $objects, null, ['class' => 'form-control select', 'id' => 'movement-sender']) }}
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input id="movement-arrival" type="checkbox" name="is_arrival" class="form-check-input arrival-check" value="is_arrival">
                            Приход материала
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Пункт назначения</label>
                    {{ Form::select('recipient_id', $objects, null, ['class' => 'form-control select', 'id' => 'movement-recipient']) }}
                </div>
                <div class="form-group">
                    <label>Количество</label>
                    {{ Form::text('count', null, ['class' => 'form-control', 'id' => 'movement-count']) }}
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input id="movement-write-off" type="checkbox" name="is_write_off" class="form-check-input write-off-check" value="is_write_off">
                            Списание без подтверждения замены
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    {{ Form::text('comment', null, ['class' => 'form-control', 'id' => 'movement-comment']) }}
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>