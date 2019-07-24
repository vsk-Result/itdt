{{ Form::open(['url' => route('sign.store'), 'method' => 'POST']) }}

    <div class="form-group">
        <label>Фамилия Имя</label>
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label>Должность</label>
        {{ Form::text('postname', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label>Email</label>
        {{ Form::text('email', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label>Мобильный телефон</label>
        {{ Form::text('phone', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label>Рабочий телефон</label>
        {{ Form::text('work_phone', null, ['class' => 'form-control']) }}
    </div>

    @if (!isset($company))
        <div class="form-group">
            <label class="d-block font-weight-semibold">Компания</label>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" value="dt" class="sign-company form-check-input-styled" name="sign_company" checked data-fouc data-url="{{ route('sign.show', 'dt') }}">
                    ДТ
                </label>
            </div>

            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" value="sti" class="sign-company form-check-input-styled" name="sign_company" data-fouc data-url="{{ route('sign.show', 'sti') }}">
                    СТИ
                </label>
            </div>

            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" value="pti" class="sign-company form-check-input-styled" name="sign_company" data-fouc data-url="{{ route('sign.show', 'pti') }}">
                    ПТИ
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>Внешняя ссылка страницы создания подписи</label>
            {{ Form::text('external_link', null, ['class' => 'form-control', 'id' => 'sign-external-link']) }}
        </div>
    @else
        {{ Form::hidden('sign_company', $company, ['class' => 'form-control']) }}
    @endif

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Скачать</button>
    </div>

{{ Form::close() }}