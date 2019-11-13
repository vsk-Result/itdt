@extends('layouts.app')

@section('title', 'Пользователи')
@section('page-title', 'Пользователи')

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="users" class="table table-lg table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Доступ к разделам</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->permissions as $permission)
                                <span class="badge badge-flat border-grey-800 text-default">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                                    <a href="{{ route('users.edit', $user) }}" class="dropdown-item text-primary edit-key"><i class="icon-pencil7"></i> Изменить</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection