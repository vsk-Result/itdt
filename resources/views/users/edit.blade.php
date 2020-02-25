@extends('layouts.app')

@section('title', 'Пользователи - Изменение доступа пользователя ' . $user->name)
@section('page-title', 'Пользователи - Изменение доступа пользователя ' . $user->name)

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="modal-body">
                {{ Form::open(['url' => route('users.update', $user), 'method' => 'PUT']) }}
                    <div class="form-group">
                        <label>Доступ к разделам</label>
                        {{ Form::select('permissions[]', $permissions, $user->permissions->pluck('id'), ['class' => 'form-control select', 'multiple' => 'multiple']) }}
                    </div>
                    <div class="form-group">
                        <label>Привязать к сотруднику</label>
                        {{ Form::select('employee_id', $employees, $user->employee_id, ['class' => 'form-control select']) }}
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>

                {{ Form::close() }}

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
        $('.select').select2({
            minimumResultsForSearch: -1
        });
    </script>
@endpush
