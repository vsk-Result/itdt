<div class="card card-body" style="box-shadow: 0 1px 2px rgba(0,0,0,.2);    border-top: 2px solid #ccc;">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::text('fullname[]', null, ['class' => 'form-control', 'placeholder' => 'ФИО']) }}
            </div>
            <div class="form-group">
                {{ Form::text('appointment[]', null, ['class' => 'form-control', 'placeholder' => 'Должность']) }}
            </div>
            <div class="form-group">
                <label for="">Фотография</label>
                <input type="file" name="avatar[]" class="form-control avatar">
            </div>
            <div class="form-group">
                {{ Form::hidden('p_id[]', 'none', []) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::text('phone[]', null, ['class' => 'form-control', 'placeholder' => 'Телефон(ы)']) }}
            </div>
            <div class="form-group">
                {{ Form::text('email[]', null, ['class' => 'form-control', 'placeholder' => 'Email(ы)']) }}
            </div>
            <div class="form-group">
                <label for="">Ссылка на профиль</label>
                {{ Form::text('link[]', null, ['class' => 'form-control', 'placeholder' => 'http(s)://...']) }}
            </div>
        </div>
    </div>
</div>