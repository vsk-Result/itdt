<div id="employeeListModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Выберите сотрудника</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    {{ Form::select('employee', $employees, null, ['class' => 'form-control employee-select']) }}
                </div>

                <div class="text-right">
                    <a href="javascript:void(0)" class="btn btn-primary employee-select-btn">Выбрать</a>
                </div>
            </div>
        </div>
    </div>
</div>