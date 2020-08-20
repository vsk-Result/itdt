<div class="card card-body" style="box-shadow: 0 1px 2px rgba(0,0,0,.2);    border-top: 2px solid #ccc;">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <a href="javascript:void(0)" class="btn btn-sm btn-primary open-employee-list">
                    Выбрать из списка
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label text-danger-800">
                        <input type="checkbox" class="form-check-input" value="{{ $person->id }}" name="person_delete[]">
                        Удалить
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::text('fullname[]', $person->fullname, ['class' => 'form-control employee-fullname', 'placeholder' => 'ФИО']) }}
            </div>
            <div class="form-group">
                {{ Form::text('appointment[]', $person->appointment, ['class' => 'form-control employee-appointment', 'placeholder' => 'Должность']) }}
            </div>
            <div class="form-group">
                <label for="">Изменить фотографию</label>
                <input type="file" name="avatar[]" class="form-control avatar fileuplouder-single">
            </div>
            <div class="form-group">
                {{ Form::hidden('p_id[]', $person->id, []) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::text('phone[]', $person->phone, ['class' => 'form-control employee-phone', 'placeholder' => 'Телефон(ы)']) }}
            </div>
            <div class="form-group">
                {{ Form::text('email[]', $person->email, ['class' => 'form-control employee-email', 'placeholder' => 'Email(ы)']) }}
            </div>
            <div class="form-group">
                <label for="">Ссылка на профиль</label>
                {{ Form::text('link[]', $person->link, ['class' => 'form-control employee-link', 'placeholder' => 'http(s)://...']) }}
            </div>
        </div>
    </div>
</div>