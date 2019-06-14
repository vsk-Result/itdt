<div id="createKey" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Новый ключ</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{ Form::open(['url' => route('keys.store'), 'method' => 'POST', 'files' => true]) }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Лицензионный ключ</label>
                                {{ Form::text('key', null, ['class' => 'form-control', 'required' => true]) }}
                            </div>

                            <div class="form-group">
                                <label>Логин антивируса</label>
                                {{ Form::text('login', null, ['class' => 'form-control', 'required' => true]) }}
                            </div>

                            <div class="form-group">
                                <label>Срок действия</label>
                                {{ Form::text('expire_date', null, ['class' => 'date form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Продукт</label>
                                {{ Form::text('product', 'ESET NOD32 Antivirus', ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                <label>Пароль антивируса</label>
                                {{ Form::text('password', null, ['class' => 'form-control', 'required' => true]) }}
                            </div>

                            <div class="form-group">
                                <label>Продление</label>
                                {{ Form::select('renewal_id', $renewalList, null, ['class' => 'select form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card-header bg-white header-elements-inline px-0">
                                <h6 class="card-title">Информация об использовании</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a href="#" class="add-usage list-icons-item text-green"><i class="icon-plus-circle2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="usage-container mt-3">
                        @include('keys.partials.usage_row')
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>