<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-lg-4 col-form-label">ФИО</label>
            <div class="col-lg-8">
                <label class="col-form-label">{{ $employee->fullname }}</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Дата рождения</label>
            <div class="col-lg-8">
                <label class="col-form-label">{{ $employee->getBirthDay() }}</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Должность</label>
            <div class="col-lg-8">
                <label class="col-form-label">{{ $employee->getPostName() }}</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Руководитель</label>
            <div class="col-lg-8">
                @if ($employee->leader)
                    <label class="col-form-label"><a href="{{ route('employees.show', $employee->leader) }}">{{ $employee->getLeaderName() }}</a></label>
                @else
                    <label class="col-form-label">{{ $employee->getLeaderName() }}</label>
                @endif
            </div>
        </div>

        @if (Auth::user()->hasPermission('users'))
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Имя пользователя</label>
                <div class="col-lg-8">
                    <label class="col-form-label">{{ $employee->user ? $employee->user->username : 'Пользователь не привязан' }}</label>
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Email</label>
            <div class="col-lg-8">
                <label class="col-form-label"><a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a></label><br>
                <label class="col-form-label"><a href="mailto:{{ $employee->email2 }}">{{ $employee->email2 }}</a></label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Рабочий номер</label>
            <div class="col-lg-8">
                <label class="col-form-label">{{ $employee->getWorkPhone() }}</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Мобильный номер</label>
            <div class="col-lg-8">
                @if (is_null($employee->phone_number) || empty($employee->phone_number))</label>
                    <label class="col-form-label">Не указан</label>
                @else
                    <label class="col-form-label"><a href="tel:{{ $employee->phone_number }}">{{ $employee->phone_number }}</a></label>
                @endif
            </div>
        </div>
    </div>
</div>