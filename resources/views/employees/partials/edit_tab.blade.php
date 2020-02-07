{{ Form::open(['url' => route('employees.update', $employee), 'method' => 'POST', 'files' => true]) }}
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>ФИО</label>
                {{ Form::text('fullname', $employee->fullname, ['class' => 'form-control', 'required' => true]) }}
            </div>
            <div class="col-md-6">
                <label>Дата рождения</label>
                {{ Form::date('birthday', $employee->birthday, ['class' => 'form-control date']) }}
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>Должность</label>
                {{ Form::select('post_id', $posts, $employee->post_id, ['class' => 'form-control select']) }}
            </div>
            <div class="col-md-6">
                <label>Руководитель</label>
                {{ Form::select('leader_id', $leaders, $employee->leader_id, ['class' => 'form-control select']) }}
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>Рабочий телефон</label>
                {{ Form::text('work_phone', $employee->work_phone, ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6">
                <label>Мобильный телефон</label>
                {{ Form::text('phone_number', $employee->phone_number, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>Корпоративная почта #1</label>
                {{ Form::text('email', $employee->email, ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6">
                <label>Корпоративная почта #2</label>
                {{ Form::text('email2', $employee->email2, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>Примечание</label>
                {{ Form::text('description', $employee->description, ['class' => 'form-control']) }}
            </div>

            <div class="col-md-6">
                <label>Загрузить фото профиля</label>
                {{ Form::file('avatar_url', ['class' => 'form-input-styled']) }}
                <span class="form-text text-muted">Формат: png, jpg</span>
            </div>
        </div>
    </div>

    <div class="text-left">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
{{ Form::close() }}