<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>ФИО пользователя</label>
            {{ Form::text('user_name[]', isset($usage) ? $usage->user_name : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Имя ПК</label>
            {{ Form::text('PC_name[]', isset($usage) ? $usage->PC_name : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>IP</label>
            {{ Form::text('IP[]', isset($usage) ? $usage->IP : null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>