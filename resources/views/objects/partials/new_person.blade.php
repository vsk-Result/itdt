<div class="card card-body" style="box-shadow: 0 1px 2px rgba(0,0,0,.2);    border-top: 2px solid #ccc;">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="javascript:void(0)" class="btn btn-sm btn-primary open-employee-list">
                    Выбрать из списка
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::text('fullname[]', null, ['class' => 'form-control employee-fullname', 'placeholder' => 'ФИО']) }}
            </div>
            <div class="form-group">
                {{ Form::text('appointment[]', null, ['class' => 'form-control employee-appointment', 'placeholder' => 'Должность']) }}
            </div>
            <div class="form-group">
                <label for="">Фотография</label>
                <input type="file" name="avatar[]" class="form-control avatar fileuplouder-single">
            </div>
            <div class="form-group">
                {{ Form::hidden('p_id[]', 'none', []) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::text('phone[]', null, ['class' => 'form-control employee-phone', 'placeholder' => 'Телефон(ы)']) }}
            </div>
            <div class="form-group">
                {{ Form::text('email[]', null, ['class' => 'form-control employee-email', 'placeholder' => 'Email(ы)']) }}
            </div>
            <div class="form-group">
                <label for="">Ссылка на профиль</label>
                {{ Form::text('link[]', null, ['class' => 'form-control employee-link', 'placeholder' => 'http(s)://...']) }}
            </div>
        </div>
    </div>
</div>