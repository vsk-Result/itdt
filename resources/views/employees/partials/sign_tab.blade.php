<div class="row">
    <div class="col-md-6 pl-3">
        @if ($employee->hasEmail('dttermo.ru'))
            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2>Подпись DTtermo</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <div class="signature sign-dt">
                            С уважением,
                            <br><br>
                            <p><b>{{ $employee->fullname }}</b></p>
                            {{ ($employee->post) ? $employee->post->name : ''}}
                            <br><br>
                            <div class="info">
                                <p>e-mail: <a class="sign-link" href="mailTo:{{ $employee->getEmail('dttermo.ru') }}">{{ $employee->getEmail('dttermo.ru') }}</a></p>
                                <p>tel: + 7 (495) 777 23 99 (#{{ $employee->work_phone }})</p>
                                <p>mob: {{ $employee->phone_number }}</p>
                                <p>Москва, Россия / Moscow, Russia</p>
                            </div>
                            <br>
                            <a class="sign-link" href="http://dttermo.ru/">www.dttermo.ru</a>
                            <br><br>
                            <img src="{{ asset('/images/dt_logo.png') }}" title="">
                            <br>
                            <a href="{{ route('employees.sign', [$employee, 'dt']) }}" class="btn btn-success w-30 mt-3">Скачать подпись</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        @if ($employee->hasEmail('st-ing.com'))
            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2>Подпись STI</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <div class="signature sign-sti">
                            С уважением,
                            <br><br>
                            <p><b>{{ $employee->fullname }}</b></p>
                            {{ ($employee->post) ? $employee->post->name : ''}}
                            <br><br>
                            <div class="info">
                                <p>e-mail: <a class="sign-link" href="mailTo:{{ $employee->getEmail('st-ing.com') }}">{{ $employee->getEmail('st-ing.com') }}</a></p>
                                <p>tel: + 7 (495) 620-35-40 (#{{ $employee->work_phone }})</p>
                                <p>mob: {{ $employee->phone_number }}</p>
                                <p>Москва, Россия / Moscow, Russia</p>
                            </div>
                            <br>
                            <a class="sign-link" href="http://st-ing.com/">www.st-ing.com</a>
                            <br><br>
                            <img src="{{ asset('/images/sti_logo.png') }}" title="">
                            <br>
                            <a href="{{ route('employees.sign', [$employee, 'sti']) }}" class="btn btn-success w-30 mt-3">Скачать подпись</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>