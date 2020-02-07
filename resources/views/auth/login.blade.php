@extends('layouts.auth_app')

@section('title', 'Вход в систему')

@section('content')
    <!-- Login form -->
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">Войти в <span class="text-green">I</span><span class="text-orange-800">T</span></h5>
                    <span class="d-block text-muted">Никому не сообщайте свой пароль</span>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="text" class="form-control{{ $errors->has('username') ? ' border-danger' : '' }}" name="username" value="{{ old('username') }}" placeholder="Имя пользователя" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-mention text-muted"></i>
                    </div>
                    @if ($errors->has('username'))
                        <label class="validation-invalid-label" for="username">{{ $errors->first('username') }}</label>
                    @endif
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" class="form-control" name="password" placeholder="Пароль" required>
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Войти <i class="icon-circle-right2 ml-2"></i></button>
                </div>

                {{--<div class="text-center">--}}
                    {{--<a href="{{ route('password.request') }}">Забыли пароль?</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </form>
    <!-- /login form -->
@endsection