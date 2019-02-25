@extends('layouts.app')

@section('title', 'Личный кабинет')
@section('page-title', 'Личный кабинет')

@section('content')
    <div class="d-flex align-items-start flex-column flex-md-row">
        <div class="card tab-content w-25 overflow-auto order-2 order-md-1">
            <div class="card-body text-center">
                <div class="card-img-actions d-inline-block mb-3">
                    <img class="img-fluid rounded-circle" src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/images/demo/users/face11.jpg" width="170" height="170" alt="">
                </div>

                <h6 class="font-weight-semibold mb-0">{{ $user->name }}</h6>
                <span class="d-block text-muted">{{ $user->email }}</span>
            </div>
        </div>

        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-300 border-0 shadow-0 order-1 order-md-2 sidebar-expand-md w-75">
            <div class="sidebar-content">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Настройки профиля</h5>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Имя</label>
                                        <input type="text" value="{{ $user->name }}" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" value="{{ $user->email }}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Новый пароль</label>
                                        <input type="password" placeholder="Enter new password" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Повтор пароля</label>
                                        <input type="password" placeholder="Repeat new password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Profile visibility</label>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice"><span class="checked"><input type="radio" name="visibility" class="form-input-styled" checked="" data-fouc=""></span></div>
                                                Visible to everyone
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice"><span><input type="radio" name="visibility" class="form-input-styled" data-fouc=""></span></div>
                                                Visible to friends only
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice"><span><input type="radio" name="visibility" class="form-input-styled" data-fouc=""></span></div>
                                                Visible to my connections only
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice"><span><input type="radio" name="visibility" class="form-input-styled" data-fouc=""></span></div>
                                                Visible to my colleagues only
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Notifications</label>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-input-styled" checked="" data-fouc=""></span></div>
                                                Password expiration notification
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-input-styled" checked="" data-fouc=""></span></div>
                                                New message notification
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-input-styled" checked="" data-fouc=""></span></div>
                                                New task notification
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled"></span></div>
                                                New contact request notification
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection