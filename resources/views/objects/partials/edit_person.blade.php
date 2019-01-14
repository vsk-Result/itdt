<div class="card card-body" style="box-shadow: 0 1px 2px rgba(0,0,0,.2);    border-top: 2px solid #ccc;">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::text('fullname[]', $person->fullname, ['class' => 'form-control', 'placeholder' => 'ФИО']) }}
            </div>
            <div class="form-group">
                {{ Form::text('appointment[]', $person->appointment, ['class' => 'form-control', 'placeholder' => 'Должность']) }}
            </div>
            <div class="form-group">
                <label for="">Изменить фотографию</label>
                <input type="file" name="avatar[]" class="form-control avatar">
            </div>
            <div class="form-group">
                {{ Form::hidden('p_id[]', $person->id, []) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::text('phone[]', $person->phone, ['class' => 'form-control', 'placeholder' => 'Телефон(ы)']) }}
            </div>
            <div class="form-group">
                {{ Form::text('email[]', $person->email, ['class' => 'form-control', 'placeholder' => 'Email(ы)']) }}
            </div>
            <div class="form-group">
                <label for="">Ссылка на профиль</label>
                {{ Form::text('link[]', $person->link, ['class' => 'form-control', 'placeholder' => 'http(s)://...']) }}
            </div>
        </div>
    </div>
</div>